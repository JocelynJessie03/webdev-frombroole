<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Akun Super Admin
        Admin::create([
            'name' => 'Super Admin Broole',
            'email' => 'super@frombroole.com',
            'password' => Hash::make('password123'), 
            'role' => 'super_admin',
        ]);

        // Akun Admin Biasa (Staff)
        Admin::create([
            'name' => 'Staff Kasir 01',
            'email' => 'kasir@frombroole.com',
            'password' => Hash::make('kasir123'),
            'role' => 'admin',
        ]);
    }
}