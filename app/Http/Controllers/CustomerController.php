<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        // 1. Inisialisasi Query & LOAD RELASI (orders, items, dan product)
        // Pastikan nama relasi di model Customer adalah 'orders'
        $query = Customer::with(['orders.items.product']);

        // 2. Logika Search (Cari berdasarkan nama, ID, atau email)
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('customer_name', 'like', '%' . $request->search . '%')
                  ->orWhere('customer_ID', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        // 3. Logika Filter Tier (Jika tombol tier diklik)
        if ($request->filled('tier')) {
            $query->where('tier', $request->tier);
        }

        // 4. Logika Top Spenders (Urutkan dari pengeluaran terbanyak)
        if ($request->sort == 'high_spend') {
            $query->orderBy('total_spend', 'desc');
        } else {
            $query->latest(); // Default: Tampilkan yang terbaru didaftarkan
        }

        // 5. Eksekusi Query
        $customers = $query->get();


        // 6. Hitung Statistik untuk Card Atas
        $goldCount = Customer::query()
            ->where('tier', 'Gold')
            ->count('*');

        $silverCount = Customer::query()
            ->where('tier', 'Silver')
            ->count('*');

        $bronzeCount = Customer::query()
            ->where('tier', 'Bronze')
            ->count('*');

        // 6. Hitung Statistik untuk Card Atas menggunakan DB::table
        $goldCount = DB::table('customers')->where('tier', '=', 'Gold')->count();
        $silverCount = DB::table('customers')->where('tier', '=', 'Silver')->count();
        $bronzeCount = DB::table('customers')->where('tier', '=', 'Bronze')->count();


        // 7. Kirim data ke View
        return view('customers', [
            'customers' => $customers,
            'goldCount' => $goldCount,
            'silverCount' => $silverCount,
            'bronzeCount' => $bronzeCount
        ]);
    }
}