<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RepositoryServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Services
        $this->app->bind(\App\Services\BookService::class, \App\Services\BookServiceConcrete::class);

        // Utils
        $this->app->bind(\App\Utils\Csv\Exporter::class, \App\Utils\Csv\ExporterConcrete::class);
    }
}
