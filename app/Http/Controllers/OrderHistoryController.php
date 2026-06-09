<?php

namespace App\Http\Controllers;

use App\Models\OrderHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderCompleteMail;

class OrderHistoryController extends Controller
{
    public function index(Request $request)
    {
        $query = OrderHistory::with([
            'customer',
            'items.product'
        ]);

        // Hide abandoned / unpaid web checkouts
        if (Schema::hasColumn('order_histories', 'payment_status')) {
            $query->where(function($q) {
                $q->where('payment_status', '!=', 'UNPAID')
                  ->orWhereNull('payment_status');
            });
        }


        if ($request->filled('search')) {

            $search = $request->get('search');

            $query->where(function ($q) use ($search) {

                $q->where('order_id', 'LIKE', "%{$search}%")

                  ->orWhere('status', 'LIKE', "%{$search}%")

                  ->orWhere('total_price', 'LIKE', "%{$search}%")

                  ->orWhereHas('customer', function ($customerQuery) use ($search) {

                      $customerQuery->where(
                          'customer_name',
                          'LIKE',
                          "%{$search}%"
                      );

                  });

                if (Schema::hasColumn('order_histories', 'payment_status')) {

                    $q->orWhere(
                        'payment_status',
                        'LIKE',
                        "%{$search}%"
                    );
                }

            });
        }


        if (
            $request->filled('status')
            &&
            $request->status !== 'all'
        ) {

            $query->where('status', $request->status);
        }


        $orders = $query
            ->latest('order_date')
            ->get();



        $totalRevenueQuery = DB::table('order_histories');



        if (Schema::hasColumn('order_histories', 'payment_status')) {

            $totalRevenueQuery->where(
                'payment_status',
                'PAID'
            );

        } else {

            $totalRevenueQuery->where(
                'status',
                'Complete'
            );
        }


        $baseStatsQuery = DB::table('order_histories');
        if (Schema::hasColumn('order_histories', 'payment_status')) {
            $baseStatsQuery->where(function($q) {
                $q->where('payment_status', '!=', 'UNPAID')
                  ->orWhereNull('payment_status');
            });
        }

        $stats = [

            'total' => (clone $baseStatsQuery)
                ->count(),

            'completed' => (clone $baseStatsQuery)
                ->where('status', 'Complete')
                ->count(),

            'pending' => (clone $baseStatsQuery)
                ->where('status', 'Pending')
                ->count(),

            'cancelled' => (clone $baseStatsQuery)
                ->where('status', 'Cancelled')
                ->count(),

            'totalRevenue' => $totalRevenueQuery
                ->sum('total_price'),

        ];



        return view(
            'order_history',
            compact('orders', 'stats')
        );
    }


    public function updateStatus($id)
{
    $order = OrderHistory::findOrFail($id);

    $order->status = 'Complete';

    if (
        Schema::hasColumn('order_histories', 'payment_status')
        &&
        !$order->payment_status
    ) {

        $order->payment_status = 'PAID';
    }



    $order->save();

    if ($order->customer && $order->customer->email) {
        Mail::to($order->customer->email)->send(new OrderCompleteMail($order));
    }

    return redirect()
        ->back()
        ->with(
            'success',
            'Order completed successfully!'
        );
}
}