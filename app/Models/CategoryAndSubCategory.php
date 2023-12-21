<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryAndSubCategory extends Model
{
    use HasFactory;

    protected $table = 'category_and_sub_categories';

    protected $fillable = [
        'category_name',
        'parent_id',
    ];


    public function children(){
        return $this->hasMany(CategoryAndSubCategory::class, 'parent_id', 'id');
    }

    public function parent(){
        return $this->belongsTo(CategoryAndSubCategory::class, 'parent_id');
    }
}
