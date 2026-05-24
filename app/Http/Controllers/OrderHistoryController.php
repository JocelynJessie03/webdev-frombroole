<?php

namespace App\Http\Controllers;

use App\Models\OrderHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Tambahkan ini wajib

class OrderHistoryController extends Controller
{
    public function index(Request $request)
    {
        // 1. Eager loading relasi agar item tidak kosong
        $query = OrderHistory::with(['customer', 'items.product']);

        // Fitur Search
        if ($request->filled('search')) {
            $query->where('order_id', 'like', '%' . $request->search . '%')
                  ->orWhereHas('customer', function($q) use ($request) {
                      $q->where('customer_name', 'like', '%' . $request->search . '%');
                  });
        }

        // Fitur Filter Status
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $orders = $query->latest('order_date')->get();

        // 2. Hitung Statistik Card menggunakan DB::table (Bebas error 4 argumen)
        $stats = [
            'total'     => DB::table('order_histories')->count(),
            'completed' => DB::table('order_histories')->where('status', 'Complete')->count(),
            'pending'   => DB::table('order_histories')->where('status', 'Pending')->count(),
            'cancelled' => DB::table('order_histories')->where('status', 'Cancelled')->count(),
        ];

        return view('order_history', compact('orders', 'stats'));
    }

    public function updateStatus($id)
    {
        $order = OrderHistory::findOrFail($id);
        
        // Cek jika statusnya masih Pending, maka ubah ke Complete
        if ($order->status === 'Pending') {
            $order->status = 'Complete';
            $order->save();
        }

        // Redirect kembali ke halaman dengan pesan sukses
        return redirect()->back()->with('success', 'Order status updated to Complete!');
    }
}