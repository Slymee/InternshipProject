<?php

namespace App\Repositories\Interfaces;

interface AdminCategoryRepositoryInterface
{
    public function getAll();

    public function create();

    public function store(array $data);

    public function edit(string $categoryId);

    public function update(array $data);

    public function destroy(string $categoryId);

    public function getPaginatedCategory(string $term);

    public function displayChildCategory(string $parentId, string $term);
}
