<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItems extends Model
{
    use HasFactory;
    protected $table = "cart_items";

    protected $fillable = [
        'buyer_id',
        'seller_id',
        'product_id',
        'quntity',
        'total_amount',
    ];
}
