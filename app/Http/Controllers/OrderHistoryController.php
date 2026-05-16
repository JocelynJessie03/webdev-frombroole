<?php

namespace App\Http\Controllers;

use App\Models\OrderHistory;
use Illuminate\Http\Request;

class OrderHistoryController extends Controller
{
    public function index(Request $request)
    {
        $query = OrderHistory::with('customer');

        // Fitur Search
        if ($request->filled('search')) {
            $query->where('order_id', 'like', '%' . $request->search . '%')
                  ->orWhereHas('customer', function($q) use ($request) {
                      $q->where('customer_name', 'like', '%' . $request->search . '%');
                  });
        }

        // Fitur Filter Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->latest('order_date')->get();

        // Hitung Statistik Card
        $stats = [
            'total'     => OrderHistory::count(),
            'completed' => OrderHistory::where('status', '=', 'Complete','and')->count(),
            'pending'   => OrderHistory::where('status', '=', 'Pending','and')->count(),
            'cancelled' => OrderHistory::where('status', '=', 'Cancelled','and')->count(),
        ];

        return view('order_history', compact('orders', 'stats'));
    }
}