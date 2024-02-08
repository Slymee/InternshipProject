<?php
declare(strict_types=1);

namespace App\Http\Controllers;


use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Category $category): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $mainParent = $category->whereNull('parent_id')->paginate(10);
        return view('backend.admin-category', compact('mainParent'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Category $category): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $data = $category->whereNull('parent_id')
        ->orWhereHas('parent', fn ($query) => $query->whereNull('parent_id'))
        ->paginate(10);
        return view('backend.modals.admin-add-category', ['datas' => $data]);
    }

    /**
     *
     *
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request): \Illuminate\Http\RedirectResponse
    {
        try{
            Category::create([
                'category_name' => $request->category_name,
                'parent_id' => $request->parent_id,
            ]);
            return redirect()->back()->with('message', 'Category Inserted.');
        }catch(\Exception $e){
            return redirect()->back()->with('message', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try{
            $editableData = Category::select('id', 'category_name','parent_id')->findOrFail($id);
            $data = Category::whereNull('parent_id')
            ->orWhereHas('parent', fn ($query) => $query->whereNull('parent_id'))
            ->paginate(10);
            return view('backend.modals.admin-edit-category', ['editableData' => $editableData],
                                                            ['datas' => $data]);
        }catch(\Exception $e){

        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request): \Illuminate\Http\RedirectResponse
    {
        try{
            Category::where('id', $request->category_id)->update([
                'category_name' => $request->category_name,
                'parent_id' => $request->parent_id,
            ]);
            return redirect()->back()->with('message', 'Edit Success!');


        }catch(\Exception $e){
            return redirect()->back()->with('message', $e->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): \Illuminate\Http\RedirectResponse
    {
        try{
            Category::find($id)->delete();
            return redirect()->back()->with('message', 'Category Deleted');
        }catch(\Exception $e){
            return redirect()->back()->with('message', $e->getMessage());
        }

    }

    /**
     * Getting paginated parent category
     * @param Category $category
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPaginatedCategory(Category $category, Request $request): \Illuminate\Http\JsonResponse
    {
        // dd($request->all());
        $term = $request->term;
        $mainParent = $category->where('category_name','like','%'.$term.'%')->whereNull('parent_id')->paginate(10);
        return response()->json(['items' => $mainParent->items()]);
    }

    /**
     * Getting paginated child category
     *
     * @param string $parentId
     * @return \Illuminate\Http\JsonResponse
     */
    public function displayChildCategory(string $parentId, Request $request): \Illuminate\Http\JsonResponse
    {
        $term = $request->term;
        $data = Category::where('category_name', 'like', '%'.$term.'%')->where('parent_id', $parentId)->paginate(10);
        return response()->json(['items' => $data->items()]);
        // return response()->json(['items' => $data->items()]);
    }
}
