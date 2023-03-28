<?php

namespace App\Providers;

use App\ServiceLayer\Inventories\InventoriesService;
use App\ServiceLayer\Inventories\InventoriesServiceInterface;
use App\ServiceLayer\Products\ProductsService;
use App\ServiceLayer\Products\ProductsServiceInterface;
use Illuminate\Support\ServiceProvider;

class ServiceLayerProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(InventoriesServiceInterface::class,InventoriesService::class);
        $this->app->bind(ProductsServiceInterface::class,ProductsService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
