<?php
declare(strict_types=1);
namespace App\Repositories;

use App\Models\Comment;
use App\Repositories\Interfaces\CommentRepositoryInterface;

class CommentRepository implements CommentRepositoryInterface
{
    public function all(): \Illuminate\Database\Eloquent\Collection
    {
        return Comment::all();
    }

    public function store($data)
    {
        return Comment::create($data);
    }



}
