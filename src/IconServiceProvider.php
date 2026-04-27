<?php

namespace AbdurRahaman\Icon;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;
use AbdurRahaman\Icon\Console\IconInstallCommand;

class IconServiceProvider extends ServiceProvider
{
    /**
     * Register services
     */
    public function register(): void
    {
        /**
         * Merge configuration from package
         */
        $this->mergeConfigFrom(
            __DIR__ . '/config/icon.php',
            'icon'
        );

        /**
         * Register artisan commands
         */
        $this->commands([
            IconInstallCommand::class,
        ]);
    }

    /**
     * Bootstrap services
     */
    public function boot(): void
    {
        /**
         * 1. Load package routes (runtime usage)
         */
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');

        /**
         * 2. Load migrations (no need to publish)
         */
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        /**
         * 3. Load views
         */
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'icon');

        /**
         * 4. Publishable resources
         */
        $this->registerPublishes();
    }

    /**
     * Define publish groups
     */
    protected function registerPublishes(): void
    {
        if ($this->app->runningInConsole()) {

            /**
             * Configuration file
             */
            $this->publishes([
                __DIR__ . '/config/icon.php' => config_path('icon.php'),
            ], 'icon-config');

            /**
             * Assets (CSS + JS)
             */
            $this->publishes([
                __DIR__ . '/resources/assets' => public_path('vendor/icon'),
            ], 'icon-assets');

            /**
             * Routes (optional external file)
             */
            $this->publishes([
                __DIR__ . '/routes/web.php' => base_path('routes/icon.php'),
            ], 'icon-routes');

            /**
             * Views (optional override)
             */
            $this->publishes([
                __DIR__ . '/resources/views' => resource_path('views/vendor/icon'),
            ], 'icon-views');
        }
    }
}