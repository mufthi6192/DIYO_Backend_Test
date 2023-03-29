<?php

namespace App\Providers;

use App\Repositories\ProductVariant\ProductVariantRepository;
use App\Repositories\ProductVariant\ProductVariantRepositoryInterface;
use App\ServiceLayer\Inventories\InventoriesService;
use App\ServiceLayer\Inventories\InventoriesServiceInterface;
use App\ServiceLayer\MerchantKey\MerchantKeyService;
use App\ServiceLayer\MerchantKey\MerchantKeyServiceInterface;
use App\ServiceLayer\Products\ProductsService;
use App\ServiceLayer\Products\ProductsServiceInterface;
use App\ServiceLayer\ProductVariant\ProductVariantService;
use App\ServiceLayer\ProductVariant\ProductVariantServiceInterface;
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
        $this->app->bind(MerchantKeyServiceInterface::class,MerchantKeyService::class);
        $this->app->bind(ProductVariantRepositoryInterface::class,ProductVariantRepository::class);
        $this->app->bind(ProductVariantServiceInterface::class,ProductVariantService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
