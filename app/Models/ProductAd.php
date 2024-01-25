<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAd extends Model
{
    use HasFactory;

    protected $table='product_ads';

    protected $fillable=[
        'user_id',
        'product_title',
        'product_description',
        'product_price',
        'image_path',
        'slug'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_category');    
    }

    public function tags()
    {
        return $this->hasMany(Tag::class, 'product_id');
    }
}
