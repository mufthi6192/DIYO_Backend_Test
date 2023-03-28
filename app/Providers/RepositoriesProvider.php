<?php

namespace App\Providers;

use App\Repositories\Inventories\InventoriesRepository;
use App\Repositories\Inventories\InventoriesRepositoryInterface;
use App\Repositories\Products\ProductRepository;
use App\Repositories\Products\ProductsRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoriesProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(InventoriesRepositoryInterface::class,InventoriesRepository::class);
        $this->app->bind(ProductsRepositoryInterface::class,ProductRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
