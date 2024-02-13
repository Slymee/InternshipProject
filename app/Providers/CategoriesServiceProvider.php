<?php

namespace App\Providers;


use App\Models\Category;
use Illuminate\Support\ServiceProvider;

class CategoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $mainCategory = Category::with('children')->whereNull('parent_id')->paginate(10);
        view()->share('mainCategory', $mainCategory);
    }
}
