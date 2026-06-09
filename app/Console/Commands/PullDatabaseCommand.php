<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class PullDatabaseCommand extends Command
{
    protected $signature = 'sync:pull {--target= : URL target server} {--token= : API Token}';
    protected $description = 'Menarik data baru dari server hosting dan menyimpannya di database lokal.';

    public function handle()
    {
        $targetUrl = $this->option('target') ?? env('SYNC_TARGET_URL');
        $token = $this->option('token') ?? env('SYNC_API_KEY', 'default-secret-key');

        if (!$targetUrl) {
            $this->error('Target URL belum disetting. Silakan set SYNC_TARGET_URL di .env (misal: https://domainhosting.com)');
            return;
        }

        $this->info("Menghubungi server $targetUrl untuk mencari data baru...");

        try {
            // Meminta data dari server
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json'
            ])->post(rtrim($targetUrl, '/') . '/api/system/sync/export');

            if (!$response->successful()) {
                $this->error("Gagal menarik data dari server: " . $response->body());
                Log::error("Pull Error", ['response' => $response->body()]);
                return;
            }

            $responseData = $response->json();
            $payload = $responseData['data'] ?? [];

            if (empty($payload)) {
                $this->info("Tidak ada data baru di server hosting. Database lokal Anda sudah sinkron.");
                return;
            }

            $this->info("Ditemukan data baru! Sedang mengimpor...");

            config(['sync.is_syncing' => true]);
            $syncedIds = [];

            DB::beginTransaction();
            foreach ($payload as $tableName => $rows) {
                if (empty($rows) || !Schema::hasTable($tableName)) continue;

                foreach ($rows as $row) {
                    $exists = DB::table($tableName)->where('id', $row['id'])->exists();
                    
                    // Tandai tersinkron di lokal
                    $row['synced_at'] = now(); 

                    if ($exists) {
                        DB::table($tableName)->where('id', $row['id'])->update($row);
                    } else {
                        DB::table($tableName)->insert($row);
                    }
                    
                    $syncedIds[$tableName][] = $row['id'];
                }
            }
            DB::commit();

            $this->info("Data berhasil disimpan di lokal. Memberi tahu server hosting...");

            // Memberitahu server hosting bahwa data ini sudah berhasil kita tarik
            $markResponse = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json'
            ])->post(rtrim($targetUrl, '/') . '/api/system/sync/mark-synced', [
                'synced_ids' => $syncedIds
            ]);

            if ($markResponse->successful()) {
                $this->info("Sinkronisasi Pull Selesai!");
            } else {
                $this->warn("Data tersimpan di lokal, tetapi gagal memberitahu hosting: " . $markResponse->body());
            }

        } catch (\Exception $e) {
            DB::rollBack();
            $this->error("Terjadi kesalahan saat memproses data: " . $e->getMessage());
            Log::error("Sync Pull Exception", ['error' => $e->getMessage()]);
        }
    }
}
