<?php

namespace App\Repositories\Interfaces;

interface SellerProductRepositoryInterface{
    public function getAll();

    public function getById($id);

    public function store(array $data);

    public function update($productId, array $data);

    public function delete($productId);
}
