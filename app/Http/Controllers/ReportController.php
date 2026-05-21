<?php

namespace App\Http\Controllers;

use App\Models\OrderHistory;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request; // WAJIB DITAMBAHKAN agar bisa membaca form

class ReportController extends Controller
{
    public function index(Request $request) // Tambahkan parameter Request di sini
    {
        // 1. Tangkap parameter filter dari URL / Form
        $startDate = $request->input('start_date'); 
        $endDate = $request->input('end_date');     
        $view = $request->input('view', 'weekly'); 

        // 2. Query dasar untuk Top Stats (Total Revenue & Orders)
        $revenueQuery = OrderHistory::where('status', 'Complete');
        $ordersQuery = OrderHistory::query();

        // Jika user melakukan filter tanggal, Top Stats ikut berubah sesuai rentang tanggal tersebut
        if ($startDate && $endDate) {
            if ($view === 'monthly') {
                $revenueQuery->whereRaw('order_date >= ? AND order_date <= ?', [$startDate . '-01 00:00:00', $endDate . '-31 23:59:59']);
                $ordersQuery->whereRaw('order_date >= ? AND order_date <= ?', [$startDate . '-01 00:00:00', $endDate . '-31 23:59:59']);
            } else {
                $revenueQuery->whereBetween('order_date', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
                $ordersQuery->whereBetween('order_date', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
            }
        }

        $totalRevenue = $revenueQuery->sum('total_price');
        $totalOrders = $ordersQuery->count();
        $avgTicket = $revenueQuery->avg('total_price') ?? 0;


        // ========================================================
        // 1. DAILY REVENUE (7 Hari Terakhir / 7 Hari Pilihan User)
        // ========================================================
        $dailyQuery = OrderHistory::where('status', 'Complete');

        if ($startDate && $endDate && $view === 'daily') {
            // Jika user memfilter, gunakan tanggal pilihan user
            $dailyQuery->whereBetween('order_date', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        } else {
            // Jika normal, jalankan logic asli kamu (6 hari lalu sampai hari ini)
            $dailyQuery->whereRaw('order_date >= DATE(DATE_SUB(NOW(), INTERVAL 6 DAY))');
        }

        $dailyRevenue = $dailyQuery->select(
                DB::raw('DATE_FORMAT(order_date, "%a") as day'),
                DB::raw('SUM(total_price) as total'),
                DB::raw('DATE(order_date) as exact_date')
            )
            ->groupBy('day', 'exact_date')
            ->orderBy('exact_date', 'asc')
            ->get();

        // ========================================================
        // 2. WEEKLY REVENUE (Kunci Permanen dari Week 1 Tahun Ini)
        // ========================================================
        $weeklyRevenue = OrderHistory::where('status', 'Complete')
        // Dikunci mati hanya untuk tahun berjalan saat ini
        ->whereRaw('YEAR(order_date) = YEAR(NOW())')
        ->select(
        DB::raw('CONCAT("Week ", WEEK(order_date) + 1) as week_num'), 
        DB::raw('SUM(total_price) as total'),
        DB::raw('WEEK(order_date) as raw_week')
        )
        ->groupBy('week_num', 'raw_week')
        ->orderBy('raw_week', 'asc') // Mulai dari Week 1 di sebelah kiri
        ->get();


        // ========================================================
        // 3. MONTHLY REVENUE (5 Bulan Terakhir / 5 Bulan Pilihan User)
        // ========================================================
        $monthlyQuery = OrderHistory::where('status', 'Complete');

        if ($startDate && $endDate && $view === 'monthly') {
            // Jika difilter, ubah format YYYY-MM jadi rentang tanggal penuh SQL
            $monthlyQuery->whereRaw('order_date >= ? AND order_date <= ?', [$startDate . '-01 00:00:00', $endDate . '-31 23:59:59']);
        } else {
            // Jika normal, gunakan logic asli kamu (4 bulan ke belakang)
            $monthlyQuery->whereRaw('order_date >= DATE_SUB(DATE_FORMAT(NOW(), "%Y-%m-01"), INTERVAL 4 MONTH)');
        }

        $monthlyRevenue = $monthlyQuery->select(
                DB::raw('DATE_FORMAT(order_date, "%b") as month'),
                DB::raw('SUM(total_price) as total'),
                DB::raw('DATE_FORMAT(order_date, "%Y-%m") as month_order')
            )
            ->groupBy('month', 'month_order')
            ->orderBy('month_order', 'asc')
            ->get();


        // Return data aman ke view blade
        return view('reports', compact(
            'totalRevenue',
            'totalOrders',
            'avgTicket',
            'dailyRevenue',
            'weeklyRevenue',
            'monthlyRevenue'
        ));
    }
}