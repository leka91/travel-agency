<?php

namespace App\Services;

use App\Models\Belgrade;
use App\Models\Category;
use App\Models\Tour;
use Illuminate\Support\Facades\Cache;

class CacheService
{
    public static function getCachedBelgrade()
    {
        return Cache::rememberForever('belgrade', function () {
            return Belgrade::first();
        });
    }
    
    public static function getCachedPopularTours()
    {
        return Cache::rememberForever('popular_tours', function () {
            return Tour::select(
                'tours.id',
                'tours.category_id',
                'tours.subtitle',
                'tours.title',
                'tours.slug',
                'tours.price',
                'tours.hero_image',
                'categories.name AS category_name',
                'categories.slug AS category_slug'
            )
            ->join('categories', 'tours.category_id', '=', 'categories.id')
            ->where('tours.is_popular', 1)
            ->latest('tours.created_at')
            ->limit(9)
            ->get();
        });
    }

    public static function getCachedTourForList($tourId)
    {
        $key = "tour_id_{$tourId}";

        return Cache::rememberForever($key, function () use ($tourId) {
            return Tour::with([
                'tags' => function ($query) {
                    $query->select('tags.name', 'tags.slug');
                }
            ])
            ->join('categories', 'tours.category_id', '=', 'categories.id')
            ->find($tourId, [
                'tours.id',
                'tours.category_id',
                'tours.is_popular',
                'tours.subtitle',
                'tours.title',
                'tours.slug',
                'tours.price',
                'tours.hero_image',
                'categories.name AS category_name',
                'categories.slug AS category_slug'
            ]);
        });
    }
    
    public static function getCachedTour($tourSlug)
    {
        $key = "tour_{$tourSlug}";
        
        return Cache::rememberForever($key, function () use ($tourSlug) {
            return Tour::with([
                'tags' => function ($query) {
                    $query->select('tags.name', 'tags.slug');
                },
                'requirements' => function ($query) {
                    $query->select('requirements.name');
                },
                'galleries' => function ($query) {
                    $query->select('galleries.image', 'galleries.tour_id');
                },
                'videos' => function ($query) {
                    $query->select('videos.video_link', 'videos.tour_id');
                },
                'prices' => function ($query) {
                    $query->select('prices.name', 'prices.amount', 'prices.tour_id');
                }
            ])
            ->join('categories', 'tours.category_id', '=', 'categories.id')
            ->where('tours.slug', $tourSlug)
            ->firstOrFail([
                'tours.id',
                'tours.user_id',
                'tours.category_id',
                'tours.title',
                'tours.subtitle',
                'tours.description',
                'tours.hero_image',
                'tours.slug',
                'tours.meta_description',
                'tours.meta_keywords',
                'categories.name AS category_name',
                'categories.slug AS category_slug'
            ]);
        });
    }
    
    public static function getCachedCategories()
    {
        return Cache::rememberForever('categories', function () {
            return Category::select('id', 'name', 'slug')
                ->withCount('tours')
                ->having('tours_count', '>', 0)
                ->get();
        });
    }
    
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
