<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Order;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderRepository implements OrderRepositoryInterface
{
    public function storeOrder(array $data)
    {
        try {
            DB::beginTransaction();

            $order = Order::create([
                'buyer_id' => $data['buyer_id'],
                'total_amount' => $data['total_amount'],
                'status' => $data['status'],
            ]);

            $pivotData[] = [
                'product_id' => $data['product_id'],
                'quantity' => $data['quantity'],
                'price' => $data['price'],
            ];
            $order->products()->attach($pivotData);

            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::error('Caught Exception: ' . $e->getMessage());
            Log::error('Exception Details: ' . $e);
            throw $e;
        }
    }
}
