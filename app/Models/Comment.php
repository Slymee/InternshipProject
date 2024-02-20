<?php
declare(strict_types=1);
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

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

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public  function replies(): HasMany
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function imagePicture(): MorphMany
    {
        return $this->morphMany(Image::class, 'imagable');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}


