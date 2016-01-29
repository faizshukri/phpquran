<?php

namespace FaizShukri\Quran;

use Illuminate\Support\ServiceProvider;

class QuranServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Quran::class, function($app){
            return new Quran($app['config']['quran']);
        });
    }

}