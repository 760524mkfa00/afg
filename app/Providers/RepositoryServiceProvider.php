<?php

namespace AFG\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
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
        $this->app->bind('AFG\Services\Repositories\Afg\AfgRepository', 'AFG\Services\Repositories\Afg\DbAfgRepository');
    }
}
