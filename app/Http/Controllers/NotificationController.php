<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    /**
     * Menandai satu notifikasi sebagai 'sudah dibaca' (is_read = true)
     */
    public function markAsRead($id)
    {
        DB::table('notifications')
            ->where('id', $id)
            ->update([
                'is_read' => true,
                'updated_at' => now()
            ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Notification marked as read.'
        ]);
    }

    /**
     * Menandai SEMUA notifikasi sekaligus sebagai 'sudah dibaca'
     */
    public function markAllAsRead()
    {
        DB::table('notifications')
            ->where('is_read', false)
            ->update([
                'is_read' => true,
                'updated_at' => now()
            ]);

        return response()->json([
            'status' => 'success',
            'message' => 'All notifications marked as read.'
        ]);
    }
}