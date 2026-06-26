<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;

class SyncController extends Controller
{
    /**
     * Endpoint untuk menerima data dari server lain (Lokal atau Hosting)
     */
    public function receive(Request $request)
    {
        // 1. Verifikasi Token Keamanan
        $token = $request->header('Authorization');
        $expectedToken = 'Bearer ' . env('SYNC_API_KEY', 'default-secret-key');
        
        if (!is_string($token) || !hash_equals($expectedToken, $token)) {
            return response()->json(['error' => 'Unauthorized. Invalid SYNC_API_KEY'], 401);
        }

        $tablesData = $request->input('data');
        if (!$tablesData || !is_array($tablesData)) {
            return response()->json(['error' => 'Invalid payload format'], 400);
        }

        // Whitelist of allowed tables to prevent arbitrary database writes
        $allowedTables = [
            'users', 'categories', 'products', 'ingredients', 'ingredient_product',
            'customers', 'order_histories', 'order_items', 'admins', 
            'ingredient_histories', 'notifications', 'tasks', 'discount_coupons', 
            'task_product', 'contact_messages', 'coupon_usages'
        ];

        // 2. Cegah observer kita sendiri mengubah synced_at menjadi null lagi saat proses simpan ini
        config(['sync.is_syncing' => true]);

        DB::beginTransaction();
        try {
            foreach ($tablesData as $tableName => $rows) {
                // Validate table name against whitelist
                if (!in_array($tableName, $allowedTables, true)) {
                    Log::warning("Sync: Rejected table '{$tableName}'");
                    continue;
                }

                // Lewati jika tabel tidak ada di database ini
                if (empty($rows) || !Schema::hasTable($tableName)) continue;

                $allowedColumns = Schema::getColumnListing($tableName);

                foreach ($rows as $row) {
                    if (!is_array($row)) continue;
                    
                    // Validate columns against schema
                    $filteredRow = array_intersect_key($row, array_flip($allowedColumns));
                    if (!isset($filteredRow['id'])) continue;

                    $exists = DB::table($tableName)->where('id', $filteredRow['id'])->exists();
                    
                    // Tandai bahwa data ini sudah disinkronisasi di server penerima
                    $filteredRow['synced_at'] = now(); 
                    
                    if ($exists) {
                        DB::table($tableName)->where('id', $filteredRow['id'])->update($filteredRow);
                    } else {
                        DB::table($tableName)->insert($filteredRow);
                    }
                }
            }
            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Data received and synchronized.']);
            
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Sync Receive Error: ' . $e->getMessage());
            return response()->json(['error' => 'Sync failed. Please check logs.'], 500);
        }
    }
    public function export(Request $request)
    {
        $token = $request->header('Authorization');
        $expectedToken = 'Bearer ' . env('SYNC_API_KEY', 'default-secret-key');
        
        if (!is_string($token) || !hash_equals($expectedToken, $token)) {
            return response()->json(['error' => 'Unauthorized. Invalid SYNC_API_KEY'], 401);
        }

        $syncableTables = [
            'users', 'categories', 'products', 'ingredients', 'ingredient_product',
            'customers', 'order_histories', 'order_items', 'admins', 
            'ingredient_histories', 'notifications', 'tasks', 'discount_coupons', 
            'task_product', 'contact_messages', 'coupon_usages'
        ];

        $payload = [];
        foreach ($syncableTables as $table) {
            if (!Schema::hasTable($table)) continue;

            $unsyncedRecords = DB::table($table)->whereNull('synced_at')->get();

            if ($unsyncedRecords->isNotEmpty()) {
                $payload[$table] = $unsyncedRecords->map(function($record) {
                    return (array) $record;
                })->toArray();
            }
        }

        return response()->json(['status' => 'success', 'data' => $payload]);
    }

    public function markSynced(Request $request)
    {
        $token = $request->header('Authorization');
        $expectedToken = 'Bearer ' . env('SYNC_API_KEY', 'default-secret-key');
        
        if (!is_string($token) || !hash_equals($expectedToken, $token)) {
            return response()->json(['error' => 'Unauthorized. Invalid SYNC_API_KEY'], 401);
        }

        $syncedIds = $request->input('synced_ids');
        if (!is_array($syncedIds)) {
            return response()->json(['error' => 'Invalid payload format'], 400);
        }

        DB::beginTransaction();
        try {
            foreach ($syncedIds as $table => $ids) {
                if (Schema::hasTable($table) && !empty($ids)) {
                    DB::table($table)->whereIn('id', $ids)->update(['synced_at' => now()]);
                }
            }
            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Records marked as synced.']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Sync Mark Error: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to mark records.'], 500);
        }
    }
}
