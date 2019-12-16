<?php

namespace Czw\Component;

use Illuminate\Support\ServiceProvider;

class ComponentServiceProvider extends ServiceProvider
{
    protected $commands = [
        Console\CreateSwiper::class,
    ];
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->commands($this->commands);

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->registerPublishing();
    }
    protected function registerPublishing()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__.'/../config' => config_path()], 'component-config');
            $this->publishes([__DIR__.'/../database/migrations' => database_path('migrations')], 'czw-migrations');
        }
    }
}
