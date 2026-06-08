<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        $allProducts = Product::with(['ingredients' => function($q) {
            $q->withPivot('amount_needed');
        }])->where('pro_delete', false)->get();

        foreach ($allProducts as $product) {
            $calculated_stock = 0;

            if ($product->ingredients->isNotEmpty()) {
                $stocks = [];
                foreach ($product->ingredients as $ingredient) {
                    $needed = $ingredient->pivot->amount_needed ?: 1; 
                    $available = floor($ingredient->stock / $needed);
                    $stocks[] = $available;
                }
                $calculated_stock = (int) max(0, min($stocks));
            }

            if ($calculated_stock <= 0) {
                $title = "Product Out of Stock!";
                $message = "Product '{$product->pro_name}' cannot be made (ingredient stock depleted).";

                // KUNCI: Cek apakah hari ini sudah pernah dibuat notif untuk produk ini
                $exists = DB::table('notifications')
                    ->where('title', $title)
                    ->where('message', $message)
                    ->whereDate('created_at', now()->toDateString()) // Hanya cek pembuatan hari ini
                    ->exists();

                if (!$exists) {
                    DB::table('notifications')->insert([
                        'id' => \Illuminate\Support\Str::uuid(),
                        'title'      => $title,
                        'message'    => $message,
                        'type'       => 'stock',
                        'is_read'    => false,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            }
        }

        // --- B. Cek Bahan Baku (Ingredient) yang Habis ---
        $outOfStockIngredients = DB::table('ingredients')->where('stock', '<=', 0)->get();
        
        foreach ($outOfStockIngredients as $ingredient) {
            $title = "Ingredient Out of Stock!";
            $message = "Ingredient '{$ingredient->name}' has run out of stock.";

            // KUNCI: Cek apakah hari ini sudah pernah dibuat notif untuk ingredient ini
            $exists = DB::table('notifications')
                ->where('title', $title)
                ->where('message', $message)
                ->whereDate('created_at', now()->toDateString()) // Hanya cek pembuatan hari ini
                ->exists();

            if (!$exists) {
                DB::table('notifications')->insert([
                        'id' => \Illuminate\Support\Str::uuid(),
                    'title'      => $title,
                    'message'    => $message,
                    'type'       => 'stock',
                    'is_read'    => false,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }

        // ==========================================
        // 2. SHARE VARIABLE $NOTIFICATIONS GLOBAL
        // ==========================================
        View::composer('*', function ($view) {
            $notifications = DB::table('notifications')
                ->orderBy('created_at', 'desc')
                ->take(10)
                ->get()
                ->map(function ($notif) {
                    $notif->created_at = Carbon::parse($notif->created_at);
                    return $notif;
                });
                
            $view->with('notifications', $notifications);
        });
    }
}