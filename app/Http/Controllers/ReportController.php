<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $view = $request->input('view', 'weekly'); 
        $startDate = $request->input('start_date'); 
        $endDate = $request->input('end_date');     

        // 1. AMANKAN DAN SET DEFAULT DATE
        if (!$startDate) {
            if ($view === 'weekly') {
                $endDate = date('Y-m-d'); 
                $startDate = date('Y-m-d', strtotime($endDate . ' -6 days')); 
            } elseif ($view === 'daily') {
                $startDate = date('Y-m-d');
                $endDate = $startDate;
            } else { // monthly
                $startDate = date('Y-m'); // Default: 2026-05
                $endDate = date('Y-m-t', strtotime($startDate . '-01'));
            }
        } else {
            if ($view === 'weekly' && !$endDate) {
                $endDate = date('Y-m-d', strtotime($startDate . ' +6 days'));
            }
        }

        // 2. STANDARISASI FORMAT UNTUK QUERY SQL
        if ($view === 'daily') {
            $sqlStart = $startDate . ' 00:00:00';
            $sqlEnd = $startDate . ' 23:59:59';
        } elseif ($view === 'weekly') {
            $sqlStart = $startDate . ' 00:00:00';
            $sqlEnd = $endDate . ' 23:59:59';
        } else { // monthly
            $cleanMonth = date('Y-m', strtotime($startDate)); 
            
            $sqlStart = $cleanMonth . '-01 00:00:00'; 
            $sqlEnd = date('Y-m-t', strtotime($sqlStart)) . ' 23:59:59'; 
            
            $startDate = $cleanMonth; 
        }

        // Query Utama untuk Top Cards
        $totalRevenue = DB::table('order_histories')
            ->where('status', 'Complete')
            ->whereBetween('order_date', [$sqlStart, $sqlEnd])
            ->sum('total_price');

        $totalOrders = DB::table('order_histories')
            ->whereBetween('order_date', [$sqlStart, $sqlEnd])
            ->count();

        // 3. QUERY PRODUCTS SOLD
        $productsSold = DB::table('order_items')
            ->join('order_histories', 'order_items.order_id', '=', 'order_histories.id')
            ->join('products', 'order_items.product_id', '=', 'products.id') 
            ->select('products.pro_name as product_name', DB::raw('SUM(order_items.quantity) as total_sold'))
            ->whereBetween('order_histories.order_date', [$sqlStart, $sqlEnd])
            ->groupBy('products.id', 'products.pro_name') 
            ->orderBy('total_sold', 'desc')
            ->get();

        $maxSold = $productsSold->first()->total_sold ?? 1;

        // =====================================================================
        // TAMBAHAN BARU: QUERY TOP CATEGORIES BANYAK TERJUAL
        // =====================================================================
        $topCategories = DB::table('order_items')
            ->join('order_histories', 'order_items.order_id', '=', 'order_histories.id')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id') // Hubungkan produk ke kategorinya
            ->select('categories.category_name', DB::raw('SUM(order_items.quantity) as total_qty'))
            ->whereBetween('order_histories.order_date', [$sqlStart, $sqlEnd])
            ->groupBy('categories.id', 'categories.category_name')
            ->orderBy('total_qty', 'desc')
            ->get();

        // Asset Array Container untuk Chart
        $dailyLabelsJson = []; $dailyTotalsJson = [];
        $weeklyLabelsJson = []; $weeklyTotalsJson = [];
        $monthlyLabelsJson = []; $monthlyTotalsJson = [];

        // LOGIKA DAILY (KEMBALI KE PER JAM)
        if ($view === 'daily') {
            for ($h = 0; $h < 24; $h++) {
                $hourStr = sprintf('%02d:00', $h);
                $dailyLabelsJson[] = $hourStr;
                $dailyTotalsJson[$hourStr] = 0;
            }
            $dbData = DB::table('order_histories')->where('status', 'Complete')->whereBetween('order_date', [$sqlStart, $sqlEnd])
                ->select(DB::raw('DATE_FORMAT(order_date, "%H:00") as label'), DB::raw('SUM(total_price) as total'))->groupBy('label')->get();
            foreach ($dbData as $row) { $dailyTotalsJson[$row->label] = (float)$row->total; }
            $dailyTotalsJson = array_values($dailyTotalsJson);
        } 
        
        // LOGIKA WEEKLY (ROLLING 7 HARI MUNDUR)
        elseif ($view === 'weekly') {
            $current = strtotime($startDate);
            $targetEnd = strtotime($endDate);
            
            while ($current <= $targetEnd) {
                $dateStr = date('Y-m-d', $current);
                $weeklyLabelsJson[$dateStr] = date('D (d/m)', $current); 
                $weeklyTotalsJson[$dateStr] = 0;
                $current = strtotime('+1 day', $current);
            }

            $dbData = DB::table('order_histories')->where('status', 'Complete')->whereBetween('order_date', [$sqlStart, $sqlEnd])
                ->select(DB::raw('DATE(order_date) as exact_date'), DB::raw('SUM(total_price) as total'))->groupBy('exact_date')->get();
            
            foreach ($dbData as $row) {
                if (isset($weeklyTotalsJson[$row->exact_date])) { 
                    $weeklyTotalsJson[$row->exact_date] = (float)$row->total; 
                }
            }
            $weeklyLabelsJson = array_values($weeklyLabelsJson);
            $weeklyTotalsJson = array_values($weeklyTotalsJson);
        } 
        
        // LOGIKA MONTHLY
        else { 
            $cleanStart = (strlen($startDate) === 7) ? $startDate . '-01' : date('Y-m-01', strtotime($startDate));
            $totalDays = date('t', strtotime($cleanStart));
            for ($d = 1; $d <= $totalDays; $d++) {
                $dayStr = sprintf('%02d', $d);
                $monthlyLabelsJson[] = $dayStr;
                $monthlyTotalsJson[$dayStr] = 0;
            }
            $dbData = DB::table('order_histories')->where('status', 'Complete')->whereBetween('order_date', [$cleanStart.' 00:00:00', $sqlEnd])
                ->select(DB::raw('DATE_FORMAT(order_date, "%d") as label'), DB::raw('SUM(total_price) as total'))->groupBy('label')->get();
            foreach ($dbData as $row) { $monthlyTotalsJson[$row->label] = (float)$row->total; }
            $monthlyTotalsJson = array_values($monthlyTotalsJson);
        }

        // Variabel 'topCategories' sekarang dikirim ke view blade
        return view('reports', compact(
            'totalRevenue', 'totalOrders', 'startDate', 'endDate', 'view',
            'dailyLabelsJson', 'dailyTotalsJson', 
            'weeklyLabelsJson', 'weeklyTotalsJson', 
            'monthlyLabelsJson', 'monthlyTotalsJson',
            'productsSold', 'maxSold', 'topCategories' 
        ));
    }
}