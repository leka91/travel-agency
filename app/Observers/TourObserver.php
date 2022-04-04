<?php

namespace App\Observers;

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
            'popular_tours',
            'categories',
            'total_all',
            'total_popular'
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
            "tour_{$tour->slug}",
            "tour_id_{$tour->id}",
            'categories'
        ]);
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
            'popular_tours',
            "tour_{$tour->slug}",
            "tour_id_{$tour->id}",
            'categories',
            'total_all',
            'total_popular'
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
            'popular_tours',
            "tour_{$tour->slug}",
            "tour_id_{$tour->id}",
            'categories',
            'total_all',
            'total_popular'
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
            'popular_tours',
            "tour_{$tour->slug}",
            "tour_id_{$tour->id}",
            'categories',
            'total_all',
            'total_popular'
        ]);
    }
}
