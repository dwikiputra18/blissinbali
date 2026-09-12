<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

	if (config('app.env') === 'production' || app()->environment('production')) {
        URL::forceScheme('https');
    }
        Notification::configureUsing(function (Notification $notification): void {
        $notification->duration(1800000); 
    });
    }
}
