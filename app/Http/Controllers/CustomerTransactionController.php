<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\OrderHistory;
use Illuminate\Support\Facades\Auth;

class CustomerTransactionController extends Controller
{
    public function index()
    {
        $customer = Customer::query()
            ->where(
                'email',
                '=',
                Auth::user()->email
            )
            ->first();

        if (!$customer) {
            abort(404);
        }
        
        $orders = OrderHistory::query()
            ->with([
                'items.product'
            ])
            ->where(
                'customer_id',
                '=',
                $customer->id
            )
            ->orderBy(
                'order_date',
                'desc'
            )
            ->get();  

        return view(
            'customer.transaction-history',
            [
                'orders' => $orders
            ]
        );
    }
}