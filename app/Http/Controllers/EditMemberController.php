<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EditMemberController extends Controller
{
    // Menampilkan halaman profil
    public function edit()
    {
        $user = Auth::user();
        
        // Mencari data customer yang emailnya sama dengan user yang sedang login
        $customer = DB::table('customers')->where('email', $user->email)->first();

        // Mengirim data $user dan $customer ke view
        return view('customer.profile.edit', compact('user', 'customer'));
    }

    // Memproses update profil
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ]);

        // 1. Update data di tabel users
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->save();

        // 2. Update data di tabel customers agar tetap sinkron (nama dan nomor telepon)
        DB::table('customers')->where('email', $user->email)->update([
            'customer_name' => $request->name,
            'phone' => $request->phone
        ]);

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}