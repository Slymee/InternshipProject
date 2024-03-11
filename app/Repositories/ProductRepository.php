<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\Category;
use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Facades\Log;

class ProductRepository implements ProductRepositoryInterface
{
    public function show(string $productId): \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Builder|array|null
    {
        try {
            return Product::with('category')->findOrFail($productId);
        } catch (\Exception $e) {
            Log::error('Caught Exception: ' . $e->getMessage());
            Log::error('Exception Details: ' . $e);
            throw $e;
        }
    }

    public function categoryProductList(string $categoryId): array
    {
        try {
            $products = Product::where('category_id', $categoryId)->paginate(10);
            $categoryName = Category::findOrFail($categoryId)->category_name;

            return [
                'categoryName' => $categoryName,
                'products' => $products,
            ];
        } catch (\Exception $e) {
            Log::error('Caught Exception: ' . $e->getMessage());
            Log::error('Exception Details: ' . $e);
            throw $e;
        }
    }
}
