<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Cart;
use App\Repositories\Interfaces\CartRepositoryInterface;
use Illuminate\Support\Facades\Log;

class CartRepository implements CartRepositoryInterface
{
    public function store(array $data)
    {
        // TODO: Implement store() method.
        try {
            $cart = Cart::where('buyer_id', $data['buyer_id'])->first();

            if (!$cart){
                $cart = Cart::create(['buyer_id' => $data['buyer_id']]);
            }

            if ($cart->products->contains($data['product_id'])) {
                $existingProduct = $cart->products->find($data['product_id']);
                $cart->products()
                    ->updateExistingPivot($data['product_id'], ['quantity' => $existingProduct->pivot->quantity + $data['quantity']]);
            } else {
                $cart->products()->attach($data['product_id'], ['quantity' => $data['quantity']]);
            }

            return true;
        }catch (\Exception $e) {
                Log::error('Caught Exception: ' . $e->getMessage());
                Log::error('Exception Details: ' . $e);
                throw $e;
            }
        }
}
