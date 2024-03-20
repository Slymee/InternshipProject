<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Repositories\Interfaces\CheckoutRepositoryInterface;

class CheckoutRepository implements CheckoutRepositoryInterface
{
    public function getCheckoutProducts(array $data)
    {
        dd($data);
    }
}
