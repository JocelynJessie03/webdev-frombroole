<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class SyncDatabaseCommand extends Command
{
    protected $signature = 'sync:database {--target= : URL target server} {--token= : API Token}';
    protected $description = 'Menyinkronkan data database yang belum tersinkron (synced_at = null) ke server target.';

    // Daftar tabel yang ingin disinkronkan (hindari tabel cache, job, dsb)
    protected $syncableTables = [
        'users', 'categories', 'products', 'ingredients', 'ingredient_product',
        'customers', 'order_histories', 'order_items', 'admins', 
        'ingredient_histories', 'notifications', 'tasks', 'discount_coupons', 
        'task_product', 'contact_messages', 'coupon_usages'
    ];

    public function handle()
    {
        $targetUrl = $this->option('target') ?? env('SYNC_TARGET_URL');
        $token = $this->option('token') ?? env('SYNC_API_KEY', 'default-secret-key');

        if (!$targetUrl) {
            $this->error('Target URL belum disetting. Silakan set SYNC_TARGET_URL di .env (misal: https://domainhosting.com)');
            return;
        }

        $this->info("Memulai sinkronisasi ke $targetUrl ...");

        $payload = [];
        $syncedIds = [];

        // Kumpulkan semua data yang synced_at masih null
        foreach ($this->syncableTables as $table) {
            if (!Schema::hasTable($table)) continue;

            $unsyncedRecords = DB::table($table)->whereNull('synced_at')->get();

            if ($unsyncedRecords->isNotEmpty()) {
                $payload[$table] = $unsyncedRecords->map(function($record) use (&$syncedIds, $table) {
                    $syncedIds[$table][] = $record->id;
                    return (array) $record;
                })->toArray();
            }
        }

        if (empty($payload)) {
            $this->info("Semua tabel sudah sinkron. Tidak ada data baru.");
            return;
        }

        $this->info("Menemukan data baru. Mengirim payload ke server target...");

        try {
            // Kirim data via POST ke API penerima
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json'
            ])->post(rtrim($targetUrl, '/') . '/api/system/sync/receive', [
                'data' => $payload
            ]);

            if ($response->successful()) {
                $this->info("Server target berhasil menerima dan menyimpan data.");
                
                // Update synced_at di lokal agar tidak dikirim ulang
                DB::beginTransaction();
                foreach ($syncedIds as $table => $ids) {
                    DB::table($table)->whereIn('id', $ids)->update(['synced_at' => now()]);
                }
                DB::commit();
                
                $this->info("Sinkronisasi Selesai!");
            } else {
                $this->error("Server menolak request: " . $response->body());
                Log::error("Sync Error", ['response' => $response->body()]);
            }
        } catch (\Exception $e) {
            $this->error("Gagal terkoneksi ke server target: " . $e->getMessage());
            Log::error("Sync Connection Error", ['error' => $e->getMessage()]);
        }
    }
}
