<?php
declare(strict_types=1);
namespace App\Repositories;

use App\Models\Comment;
use App\Models\Product;
use App\Models\User;
use App\Repositories\Interfaces\CommentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CommentRepository implements CommentRepositoryInterface
{
    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return Comment::all();
    }

    /**
     * @param $data
     * @return mixed
     */
    public function store($data): mixed
    {
        $product = Product::find($data['product_id']);
        $comment = $product->comments()->create($data);
        if ($data['image_path']){
            $comment->images()->create([
                'image_path' => $data['image_path'],
            ]);
        }
        return $comment;
    }

}
