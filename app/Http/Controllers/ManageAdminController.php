<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ManageAdminController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            function ($request, $next) {
                $user = Auth::guard('admin')->user() ?? Auth::user();
                if (!$user || $user->role !== 'super_admin') {
                    abort(403, 'Unauthorized action.');
                }
                return $next($request);
            }
        ];
    }

    public function index()
    {
        $admins = Admin::all();
        return view('manage_admin', compact('admins'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:admins',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,super_admin',
        ]);

        Admin::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('manage_admin.index')->with('success', 'Admin created successfully.');
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:admins,username,' . $admin->id,
            'email' => 'required|string|email|max:255|unique:admins,email,' . $admin->id,
            'role' => 'required|in:admin,super_admin',
        ]);

        $admin->name = $request->name;
        $admin->username = $request->username;
        $admin->email = $request->email;
        $admin->role = $request->role;

        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        $admin->save();

        return redirect()->route('manage_admin.index')->with('success', 'Admin updated successfully.');
    }

    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);

        // Prevent deleting oneself
        $currentUser = Auth::guard('admin')->user() ?? Auth::user();
        if ($admin->id === $currentUser->id) {
            return redirect()->route('manage_admin.index')->with('error', 'Cannot delete yourself.');
        }

        $admin->delete();

        return redirect()->route('manage_admin.index')->with('success', 'Admin deleted successfully.');
    }
}
