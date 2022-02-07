<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class CacheService
{
    public static function clearCachedKeys($cachedKeys)
    {
        foreach ($cachedKeys as $cachedKey) {
            if (Cache::has($cachedKey)) {
                Cache::forget($cachedKey);
            }
        }
    }
}
