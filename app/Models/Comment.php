<?php
declare(strict_types=1);
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';

    protected $fillable = [
        'user_id',
        'product_id',
        'parent_id',
        'comment',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public  function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}


