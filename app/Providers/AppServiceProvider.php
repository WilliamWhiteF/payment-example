<?php

namespace App\Providers;

use App\Shared\Interfaces\NotificationInterface;
use App\Shared\Notifications\DefaultNotification;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(NotificationInterface::class, DefaultNotification::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
