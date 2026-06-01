<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    // =========================================================================
    //  SHOP — Product listing with category filter
    // =========================================================================

    public function index(Request $request)
    {
        // 1. Fetch active categories for the filter pill-tabs
        $categories = DB::table('categories')
            ->where('category_name', '!=', 'Uncategorized')
            ->where('category_delete', false)
            ->get();

        // 2. Fetch products with their category & ingredient relations
        //    (ingredients are needed to compute calculated_stock via the Accessor)
        $query = Product::with([
            'category',
            'ingredients' => function ($q) {
                $q->withPivot('amount_needed');
            },
        ])->where('pro_delete', false);

        // 3. Filter by category tab if one is selected
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // 4. Execute query
        $products = $query->latest()->get();

        // 5. Sort: in-stock items first, sold-out last
        $products = $products->sortByDesc(function ($product) {
            return $product->calculated_stock > 0 ? 1 : 0;
        })->values();

        return view('customer.shop', compact('products', 'categories'));
    }

    // =========================================================================
    //  CART — Renders the cart view
    //
    //  The actual cart data (items, qty, sugar level, etc.) lives entirely in
    //  the browser's localStorage under the key "customer_cart".  This method
    //  only needs to render the Blade shell; JavaScript does the rest.
    //
    //  If in the future you want server-side cart persistence (e.g. for
    //  logged-in users), you can pass extra data from here — the view is
    //  already wired to accept it via window.serverCart below.
    // =========================================================================

    public function cart()
    {
        return view('customer.cart');
    }

    // =========================================================================
    //  CHECKOUT — Receives the order payload posted from the cart page
    //
    //  The cart page POSTs a JSON body with:
    //    {
    //      items:    [ { id, name, price, qty, sugarLevel, isDrink, ... } ],
    //      notes:    "Special instructions string",
    //      promo:    "PROMO_CODE" | null,
    //      discount: 0–100   (percentage)
    //    }
    //
    //  Validate stock server-side here before creating an order — never trust
    //  the client's calculated_stock alone.
    // =========================================================================

    public function checkout(Request $request)
    {
        // 1. Validate the incoming payload
        $validated = $request->validate([
            'items'            => ['required', 'array', 'min:1'],
            'items.*.id'       => ['required', 'integer', 'exists:products,id'],
            'items.*.qty'      => ['required', 'integer', 'min:1'],
            'items.*.price'    => ['required', 'numeric', 'min:0'],
            'items.*.sugarLevel' => ['nullable', 'in:0,50,100'],
            'notes'            => ['nullable', 'string', 'max:500'],
            'promo'            => ['nullable', 'string', 'max:30'],
            'discount'         => ['nullable', 'integer', 'min:0', 'max:100'],
        ]);

        // 2. Re-verify stock for every item (server-side guard)
        $errors = [];
        foreach ($validated['items'] as $lineItem) {
            $product = Product::with(['ingredients' => function ($q) {
                $q->withPivot('amount_needed');
            }])->find($lineItem['id']);

            if (! $product || $product->pro_delete) {
                $errors[] = ($product->pro_name ?? 'A product') . ' is no longer available.';
                continue;
            }

            if ($product->calculated_stock < $lineItem['qty']) {
                $errors[] = 'Only ' . $product->calculated_stock . ' unit(s) of "' . $product->pro_name . '" are available.';
            }
        }

        if (! empty($errors)) {
            return response()->json([
                'success' => false,
                'errors'  => $errors,
            ], 422);
        }

        // 3. TODO: Create order record, deduct stock, send confirmation, etc.
        //    Example:
        //    $order = Order::create([...]);
        //    foreach ($validated['items'] as $lineItem) { ... }

        // 4. Return success — the cart page will clear localStorage and redirect
        return response()->json([
            'success'      => true,
            'message'      => 'Order placed successfully!',
            // 'order_id'  => $order->id,   // uncomment when Order model exists
            'redirect_url' => route('customer.shop'), // change to order-confirmation route
        ]);
    }

    // =========================================================================
    //  VALIDATE COUPON — Validates a coupon code and returns discount percentage
    // =========================================================================

    public function validateCoupon(Request $request)
    {
        $code = $request->input('code', '');

        if (!$code) {
            return response()->json([
                'valid' => false,
                'message' => 'Coupon code is required.',
            ]);
        }

        // Search for the coupon in discount_coupons table
        $coupon = \App\Models\DiscountCoupon::where('code', strtoupper($code))
            ->where('is_active', true)
            ->first();

        if (!$coupon) {
            return response()->json([
                'valid' => false,
                'message' => 'Invalid coupon code.',
            ]);
        }

        // Check if coupon has expired
        if ($coupon->expires_at && now()->isAfter($coupon->expires_at)) {
            return response()->json([
                'valid' => false,
                'message' => 'This coupon has expired.',
            ]);
        }

        // Check if coupon has reached max uses
        if ($coupon->max_uses && $coupon->times_used >= $coupon->max_uses) {
            return response()->json([
                'valid' => false,
                'message' => 'This coupon has reached its usage limit.',
            ]);
        }

        // Coupon is valid
        return response()->json([
            'valid' => true,
            'code' => $coupon->code,
            'discount_value' => $coupon->discount_value,
            'discount_type' => $coupon->discount_type,
            'message' => 'Coupon applied successfully!',
        ]);
    }
}