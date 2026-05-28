<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ingredient;

class IngredientSeeder extends Seeder
{
    public function run(): void
    {
        $ingredients = [
            ['name' => 'Egg', 'stock' => 100, 'unit' => 'pcs'],
            ['name' => 'Milk', 'stock' => 50000, 'unit' => 'ml'],
            ['name' => 'Sugar', 'stock' => 10000, 'unit' => 'gr'],
            ['name' => 'Matcha Powder', 'stock' => 2000, 'unit' => 'gr'],
            ['name' => 'Cocoa Powder', 'stock' => 2000, 'unit' => 'gr'],
            ['name' => 'Salt', 'stock' => 1000, 'unit' => 'gr'],
            ['name' => 'Vanilla Syrup', 'stock' => 5000, 'unit' => 'ml'],
            ['name' => 'Tea', 'stock' => 1000, 'unit' => 'gr'],
            ['name' => 'Oreo', 'stock' => 50, 'unit' => 'pcs'],
            ['name' => 'Regal', 'stock' => 50, 'unit' => 'pcs'],
            ['name' => 'Strawberry Jam', 'stock' => 3000, 'unit' => 'gr'],
            ['name' => 'Blueberry Jam', 'stock' => 3000, 'unit' => 'gr'],
            ['name' => 'Heavy Cream', 'stock' => 10000, 'unit' => 'ml'],
            ['name' => 'Thaitea Powder', 'stock' => 2000, 'unit' => 'gr'],
            ['name' => 'Coffee Powder', 'stock' => 2000, 'unit' => 'gr'],
            ['name' => 'Cream Cheese', 'stock' => 5000, 'unit' => 'gr'],
            ['name' => 'Ice Cube', 'stock' => 10000, 'unit' => 'gr'],
            // pcsaging / Alat Makan
            ['name' => 'Alumunium', 'stock' => 200, 'unit' => 'pcs'],
            ['name' => 'Cup', 'stock' => 500, 'unit' => 'pcs'],
            ['name' => 'Straw', 'stock' => 500, 'unit' => 'pcs'],
            ['name' => 'Paper Box', 'stock' => 300, 'unit' => 'pcs'],
            ['name' => 'Spork', 'stock' => 500, 'unit' => 'pcs'],
        ];

        foreach ($ingredients as $item) {
            Ingredient::create($item);
        }
    }
}