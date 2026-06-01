<?php

namespace App\Http\Controllers;

use App\Models\OrderHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class OrderHistoryController extends Controller
{
    public function index(Request $request)
    {
        $query = OrderHistory::with([
            'customer',
            'items.product'
        ]);


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


        $stats = [

            'total' => DB::table('order_histories')
                ->count(),

            'completed' => DB::table('order_histories')
                ->where('status', 'Complete')
                ->count(),

            'pending' => DB::table('order_histories')
                ->where('status', 'Pending')
                ->count(),

            'cancelled' => DB::table('order_histories')
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

    return redirect()
        ->back()
        ->with(
            'success',
            'Order completed successfully!'
        );
}
}