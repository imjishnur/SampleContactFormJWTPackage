<?php

namespace Vendor\ContactForm;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class ContactFormServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/contact-form.php', 'contact-form');
    }

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'contact-form');

        $this->registerRoutes();

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/config/contact-form.php' => config_path('contact-form.php'),
            ], 'config');

            $this->publishes([
                __DIR__ . '/resources/views' => resource_path('views/vendor/contact-form'),
            ], 'views');
        }
    }

    protected function registerRoutes()
    {
        Route::group(['prefix' => 'api', 'middleware' => 'api'], function () {
            $this->loadRoutesFrom(__DIR__ . '/routes/api.php');
        });

        Route::group(['middleware' => 'web'], function () {
            $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        });
    }
}
