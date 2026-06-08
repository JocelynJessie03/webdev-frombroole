<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

trait Syncable
{
    use HasUuids, SoftDeletes;

    /**
     * Boot the Syncable trait for a model.
     */
    public static function bootSyncable()
    {
        static::saved(function ($model) {
            // Jika perubahan bukan berasal dari proses Sinkronisasi itu sendiri,
            // maka tandai data ini butuh di-sync (synced_at = null)
            if (!config('sync.is_syncing', false)) {
                DB::table($model->getTable())
                    ->where('id', $model->id)
                    ->update(['synced_at' => null]);
            }
        });

        static::deleted(function ($model) {
            if (!config('sync.is_syncing', false)) {
                DB::table($model->getTable())
                    ->where('id', $model->id)
                    ->update(['synced_at' => null]);
            }
        });
    }
}
