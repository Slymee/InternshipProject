<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'category_name',
        'parent_id',
    ];


    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function ancestors()
    {
        return $this->parent ? $this->parent->ancestors()->concat([$this->parent]) : collect([]);
    }

    public function getLevelAttribute()
    {
        return $this->ancestors()->count();
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

}
