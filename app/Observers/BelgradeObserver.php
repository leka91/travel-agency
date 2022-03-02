<?php

namespace App\Observers;

use App\Models\Belgrade;
use App\Services\CacheService;

class BelgradeObserver
{
    /**
     * Handle the Belgrade "created" event.
     *
     * @param  \App\Models\Belgrade  $belgrade
     * @return void
     */
    public function created(Belgrade $belgrade)
    {
        CacheService::clearCachedKeys([
            'belgrade'
        ]);
    }

    /**
     * Handle the Belgrade "updated" event.
     *
     * @param  \App\Models\Belgrade  $belgrade
     * @return void
     */
    public function updated(Belgrade $belgrade)
    {
        CacheService::clearCachedKeys([
            'belgrade'
        ]);
    }

    /**
     * Handle the Belgrade "deleted" event.
     *
     * @param  \App\Models\Belgrade  $belgrade
     * @return void
     */
    public function deleted(Belgrade $belgrade)
    {
        //
    }

    /**
     * Handle the Belgrade "restored" event.
     *
     * @param  \App\Models\Belgrade  $belgrade
     * @return void
     */
    public function restored(Belgrade $belgrade)
    {
        //
    }

    /**
     * Handle the Belgrade "force deleted" event.
     *
     * @param  \App\Models\Belgrade  $belgrade
     * @return void
     */
    public function forceDeleted(Belgrade $belgrade)
    {
        //
    }
}
