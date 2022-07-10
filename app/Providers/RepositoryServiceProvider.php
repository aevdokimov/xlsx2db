<?php

namespace App\Providers;

use App\Interfaces\ImportProgressRepositoryInterface;
use App\Interfaces\RowsRepositoryInterface;
use App\Repositories\ImportProgressRepository;
use App\Repositories\RowsRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ImportProgressRepositoryInterface::class, ImportProgressRepository::class);
        $this->app->bind(RowsRepositoryInterface::class, RowsRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
