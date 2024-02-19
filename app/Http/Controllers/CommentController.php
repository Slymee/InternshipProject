<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Http\Requests\ProductCommentRequest;
use App\Models\Comment;
use App\Repositories\Interfaces\CommentRepositoryInterface;

class CommentController extends Controller
{
    private $commentRepository;

    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductCommentRequest $request): \Illuminate\Http\RedirectResponse
    {
        $imageName = null;
        $imagePath = null;
        if ($request->has('comment_image')){
            $imageName = 'comment'.time().'image'.'.'.$request->comment_image->extension();
            $imagePath = $request->file('comment_image')->storeAs('images', $imageName, 'public');
        }
        $request->merge(['image_path' => $imagePath]);

        $this->commentRepository->store($request->all());

        return redirect()->back()->with('message', "Comment posted!!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
