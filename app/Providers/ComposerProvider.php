<?php

namespace AFG\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('view')->composer(['projects.create'], 'AFG\Composers\PriorityComposer');
        $this->app->make('view')->composer(['projects.create'], 'AFG\Composers\CategoryComposer');
        $this->app->make('view')->composer(['projects.create'], 'AFG\Composers\ClientComposer');
        $this->app->make('view')->composer(['projects.create'], 'AFG\Composers\LocationComposer');
        $this->app->make('view')->composer(['projects.create'], 'AFG\Composers\ManagerComposer');
        $this->app->make('view')->composer(['projects.create'], 'AFG\Composers\RegionComposer');
    }
}
