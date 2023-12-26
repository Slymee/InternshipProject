<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Category::whereNull('parent_id')->get();
        return view('backend.adminCategory', ['datas' => $datas]);
    }

    //Add Category Form
    public function addCategoryFormDisplay(){
        $datas = Category::whereNull('parent_id')
        ->orWhereHas('parent', fn ($query) => $query->whereNull('parent_id'))
        ->get();
        
        return view('backend.modals.adminAddCategory', ['datas' => $datas]);
    }

    /**
     * Insert new category.
     */
    public function insertCategory(Request $request)
    {
        try{
            $request->validate([
                'category_name' => ['bail', 'required'],
                'parent_id' => ['nullable', 'exists:categories,id'],
            ]);

            Category::create([
                'category_name' => $request->category_name,
                'parent_id' => $request->parent_id,
            ]);

            return redirect()->back()->with('message', 'Insert Success.');

        }catch(\Exception $e){
            return redirect()->back()->with('message', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $categoryAndSubCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($category_id)
    {
        $editableData = Category::select('category_name','parent_id')->findOrFail($category_id);
        $datas = Category::whereNull('parent_id')
        ->orWhereHas('parent', fn ($query) => $query->whereNull('parent_id'))
        ->get();
        return view('backend.modals.adminEditCategory', ['editableData' => $editableData],
                                                        ['datas' => $datas]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $categoryAndSubCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $categoryAndSubCategory)
    {
        //
    }
}
