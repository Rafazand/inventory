<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\ProductRepository;
use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\CategoryRepository;
use App\Repositories\SupplierRepositoryInterface;
use App\Repositories\SupplierRepository;
use App\Repositories\OrderRepositoryInterface;
use App\Repositories\OrderRepository;
use App\Repositories\OrderItemRepositoryInterface;
use App\Repositories\OrderItemRepository;
use App\Services\MenuServiceInterface;
use App\Services\MenuService;
use App\Contracts\AuthServiceInterface;
use App\Services\AuthService;
use App\Providers\OrderItemService;
use App\Interfaces\ThemeServiceInterface;
use App\Services\ThemeService;
use App\Interfaces\SupplierValidationInterface;
use App\Services\SupplierValidationService;
use App\Contracts\TokenServiceInterface;
use App\Services\TokenService;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(SupplierRepositoryInterface::class, SupplierRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(OrderItemRepositoryInterface::class, OrderItemRepository::class);
        $this->app->bind(MenuServiceInterface::class, MenuService::class);
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
        $this->app->bind(ThemeServiceInterface::class, ThemeService::class);
        $this->app->bind(SupplierValidationInterface::class, SupplierValidationService::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(TokenServiceInterface::class, TokenService::class);
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
