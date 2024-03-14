<?php
declare(strict_types=1);

namespace App\Providers;

use App\Repositories\AdminCategoryRepository;
use App\Repositories\CartItemsRepository;
use App\Repositories\CommentRepository;
use App\Repositories\Interfaces\AdminCategoryRepositoryInterface;
use App\Repositories\Interfaces\CartItemsRepositoryInterface;
use App\Repositories\Interfaces\CommentRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\Interfaces\SellerProductRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\ProductRepository;
use App\Repositories\SellerProductRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CommentRepositoryInterface::class, CommentRepository::class);
        $this->app->bind(SellerProductRepositoryInterface::class, SellerProductRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(AdminCategoryRepositoryInterface::class, AdminCategoryRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(CartItemsRepositoryInterface::class, CartItemsRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
