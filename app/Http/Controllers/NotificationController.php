<?php

namespace App\Http\Controllers;

use App\Models\Notification;

class NotificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | MARK SINGLE NOTIFICATION
    |--------------------------------------------------------------------------
    */

    public function markAsRead($id)
    {
        $notification =
            Notification::findOrFail($id);

        $notification->is_read = true;

        $notification->save();

        return response()->json([
            'success' => true
        ]);
    }



    /*
    |--------------------------------------------------------------------------
    | MARK ALL NOTIFICATIONS
    |--------------------------------------------------------------------------
    */

    public function markAllAsRead()
    {
        Notification::where(
            'is_read',
            false
        )->update([
            'is_read' => true
        ]);

        return response()->json([
            'success' => true
        ]);
    }
}