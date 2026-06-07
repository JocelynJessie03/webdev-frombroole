<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        if (!User::where('email', 'test@example.com')->exists()) {
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);
        }
        $this->call([
        CustomerSeeder::class,
        CategorySeeder::class,
        AdminSeeder::class,
        IngredientSeeder::class,
        ProductSeeder::class,
        OrderHistorySeeder::class,
        OrderItemSeeder::class,
        TaskSeeder::class,
        // Anda bisa menambahkan seeder lain di sini nanti
    ]);
    }
}
