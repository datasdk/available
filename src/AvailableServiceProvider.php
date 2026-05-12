<?php

namespace DataSDK\Available;

use Illuminate\Support\ServiceProvider;

class AvailableServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/available.php' => config_path('available.php'),
            ], 'config');
        }
    }
}
