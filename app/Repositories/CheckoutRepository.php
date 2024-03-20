<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\CheckoutRepositoryInterface;

class CheckoutRepository implements CheckoutRepositoryInterface
{
    public function getCheckoutProducts(string $productId)
    {
        return Product::find($productId);
    }
}
