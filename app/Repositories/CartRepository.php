<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Cart;
use App\Repositories\Interfaces\CartRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class CartRepository implements CartRepositoryInterface
{
    /**
     * @param string $userId
     * @return mixed
     */
    public function showCartItems(string $userId)
    {
        // TODO: Implement showCartItems() method.

        return Cart::where('buyer_id', $userId)
            ->with('product')
            ->paginate(10);
    }

    /**
     * @param array $data
     * @return bool
     */
    public function store(array $data): bool
    {
        // TODO: Implement store() method.
        try {
            $cart = Cart::where('buyer_id', $data['buyer_id'])
                ->where('product_id', $data['product_id'])
                ->first();

            if ($cart){
                $cart->quantity += $data['quantity'];
                $cart->amount = $cart->quantity * $data['price'];
                $cart->save();
            }else{
                Cart::create([
                    'buyer_id' => $data['buyer_id'],
                    'product_id' => $data['product_id'],
                    'quantity' => $data['quantity'],
                    'price' => $data['price'],
                    'amount' => ($data['quantity']*$data['price']),
                ]);
            }
            return true;
        }catch (\Exception $e){
            DB::rollBack();
            Log::error('Caught Exception: ' . $e->getMessage());
            Log::error('Exception Details: ' . $e);
            return false;
        }
    }


    public function updateQuantity(array $data): bool
    {
        try {
            $cartItem = Cart::findOrFail($data['cart_id']);
            $cartItem->quantity = $data['quantity'];
            $cartItem->amount = $data['quantity']*$data['price'];

            $cartItem->save();
            return true;
        }catch (\Exception $e){
            Log::error('Caught Exception: ' . $e->getMessage());
            Log::error('Exception Details: ' . $e);
            return false;
        }
    }

    /**
     * @param string $cartId
     * @return bool
     */
    public function removeFromCart(string $cartId): bool
    {
        try {
            if (Cart::find($cartId)->delete()){
                return true;
            }
            return false;
        }catch (\Exception $e){
            DB::rollBack();
            Log::error('Caught Exception: ' . $e->getMessage());
            Log::error('Exception Details: ' . $e);
            return false;
        }
    }
}
