<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\CartItems;
use App\Repositories\Interfaces\CartItemsRepositoryInterface;

class CartItemsRepository implements CartItemsRepositoryInterface
{
    public function store(array $data)
    {
        $cartItem = CartItems::where('buyer_id', $data['buyer_id'])
            ->where('product_id', $data['product_id'])
            ->first();

        if ($cartItem)
        {
            $cartItem->quantity += $data['quantity'];
            $cartItem->amount += $data['quantity'] * $data['price'];
            $cartItem->save();
            echo 'success:updated';
        }else{
            CartItems::create([
                'buyer_id' => $data['buyer_id'],
                'seller_id' => $data['seller_id'],
                'product_id' => $data['product_id'],
                'quantity' => $data['quantity'],
                'amount' => $data['price'],
            ]);
            echo 'success:inserted';
        }
    }
}
