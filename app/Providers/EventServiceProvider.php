<?php

namespace App\Providers;

use App\Models\Belgrade;
use App\Models\Category;
use App\Models\Tour;
use App\Observers\BelgradeObserver;
use App\Observers\CategoryObserver;
use App\Observers\TourObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Tour::observe(TourObserver::class);
        Category::observe(CategoryObserver::class);
        Belgrade::observe(BelgradeObserver::class);
    }
}
