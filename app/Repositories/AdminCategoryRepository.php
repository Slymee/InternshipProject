<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Interfaces\AdminCategoryRepositoryInterface;

class AdminCategoryRepository implements AdminCategoryRepositoryInterface
{
    public function getAll()
    {
        return Category::whereNull('parent_id')->paginate(10);
    }

    public function store()
    {

    }

    public function edit(string $categoryId)
    {

    }

    public function update(string $categoryId)
    {

    }

    public function destroy(string $categoryId)
    {

    }

    public function getPaginatedCategory()
    {

    }

    public function displayChildCategory(string $parentId)
    {

    }
}
