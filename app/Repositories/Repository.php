<?php
declare(strict_types=1);
namespace App\Repositories;

use App\Models\Comment;
use App\Repositories\Interfaces\RepositoryInterface;

abstract class Repository implements RepositoryInterface
{
    public function all(): \Illuminate\Database\Eloquent\Collection
    {
        return Comment::all();
    }
}
