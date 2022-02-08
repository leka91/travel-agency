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

    public static function clearPaginateCachedKeys($prefixes)
    {
        foreach ($prefixes as $prefix) {
            for ($i = 1; $i <= 100; $i++) {
                $key = $prefix . $i;

                if (Cache::has($key)) {
                    Cache::forget($key);
                } else {
                    break;
                }
            }
        }
    }
}
