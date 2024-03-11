<?php

namespace App\Repositories\Interfaces;

interface AdminCategoryRepositoryInterface
{
    public function getAll();

    public function store();

    public function edit(string $categoryId);

    public function update(string $categoryId);

    public function destroy(string $categoryId);

    public function getPaginatedCategory();

    public function displayChildCategory(string $parentId);
}
