<?php

namespace Yadda\LaravelHeartbeat;

use Illuminate\Support\ServiceProvider;
use Yadda\LaravelHeartbeat\Console\Heartbeat;

class LaravelHeartbeatServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'laravel-heartbeat');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-heartbeat');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-heartbeat');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('laravel-heartbeat.php'),
            ], 'config');

            // Publishing the views.
            // $this->publishes([
            //     __DIR__.'/../resources/views' => resource_path('views/vendor/laravel-heartbeat'),
            // ], 'views');

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/laravel-heartbeat'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/laravel-heartbeat'),
            ], 'lang');*/

            // Registering package commands.
            $this->commands([
                Heartbeat::class,
            ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'laravel-heartbeat');

        // Register the main class to use with the facade
        $this->app->singleton('laravel-heartbeat', function () {
            return new LaravelHeartbeat;
        });
    }
}
