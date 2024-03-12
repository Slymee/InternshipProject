<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCommentRequest;
use App\Models\Comment;
use App\Repositories\Interfaces\CommentRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    private $commentInterface;

    public function __construct(CommentRepositoryInterface $commentInterface)
    {
        $this->commentInterface = $commentInterface;
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
    public function store(ProductCommentRequest $request): RedirectResponse
    {
//        dd($request->toArray());
        try {
            $imageName = null;
            $imagePath = null;
            if ($request->hasFile('comment_image')){
                $imageName = 'comment' . time() . 'image' . '.' . $request->comment_image->extension();
                $imagePath = $request->file('comment_image')->storeAs('images', $imageName, 'public');
            }

            $request->merge(['image_path' => $imagePath]);

//            dd($request->all());

            $this->commentInterface->store($request->all());
            return redirect()->back()->with('message', 'Comment Posted.');
        }catch (\Exception $e){
            Log::error('Caught Exception: '. $e);
            return redirect()->back()->with('message', $e->getMessage());
        }
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
