<?php

namespace App\Observers;

use App\Models\Tag;
use App\Models\Tour;
use App\Services\CacheService;

class TourObserver
{
    /**
     * Handle the Tour "created" event.
     *
     * @param  \App\Models\Tour  $tour
     * @return void
     */
    public function created(Tour $tour)
    {
        CacheService::clearCachedKeys([
            'popular_tours'
        ]);
    }

    /**
     * Handle the Tour "updated" event.
     *
     * @param  \App\Models\Tour  $tour
     * @return void
     */
    public function updated(Tour $tour)
    {
        CacheService::clearCachedKeys([
            'popular_tours',
            "tour_{$tour->slug}"
        ]);

        // category_tours_

        $prefixes = [
            'tours_'
        ];

        $tags = Tag::pluck('slug');

        if ($tags->count()) {
            foreach ($tags as $tagSlug) {
                $prefixes[] = "tag_tours_{$tagSlug}_";
            }
        }

        CacheService::clearPaginateCachedKeys($prefixes);
    }

    /**
     * Handle the Tour "deleted" event.
     *
     * @param  \App\Models\Tour  $tour
     * @return void
     */
    public function deleted(Tour $tour)
    {
        CacheService::clearCachedKeys([
            'popular_tours'
        ]);
    }

    /**
     * Handle the Tour "restored" event.
     *
     * @param  \App\Models\Tour  $tour
     * @return void
     */
    public function restored(Tour $tour)
    {
        CacheService::clearCachedKeys([
            'popular_tours'
        ]);
    }

    /**
     * Handle the Tour "force deleted" event.
     *
     * @param  \App\Models\Tour  $tour
     * @return void
     */
    public function forceDeleted(Tour $tour)
    {
        CacheService::clearCachedKeys([
            'popular_tours'
        ]);
    }
}
