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
    public function subCategoryIndex($id)
    {
        $parentCategory = Category::find($id);
        $immediateChildren = $parentCategory->children;
        $subSubCategories = [];

        foreach ($immediateChildren as $child) {
            $subSubCategories[$child->id] = $child->children;
        }
        
        
        return view('backend.adminSubCategory', compact('parentCategory', 'immediateChildren', 'subSubCategories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($category_id)
    {
        $editableData = Category::select('id', 'category_name','parent_id')->findOrFail($category_id);
        $datas = Category::whereNull('parent_id')
        ->orWhereHas('parent', fn ($query) => $query->whereNull('parent_id'))
        ->get();
        return view('backend.modals.adminEditCategory', ['editableData' => $editableData],
                                                        ['datas' => $datas]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try{
            $request->validate([
                'category_name' => ['bail', 'required'],
                'category_id' => ['required'],
                'parent_id' => ['nullable', 'exists:categories,id'],
            ]);


    
            $category = Category::find($request->input('category_id'));
            $category->update($request->all());
            $category->save();
            return redirect()->back()->with('message', 'Edit Successful');
    
        }catch(\Exception $e){
            return redirect()->back()->with('message', $e->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($category_id)
    {
        try{
            Category::find($category_id)->recursiveDelete();
            return redirect()->back()->with('message', 'Category Deleted');
        }catch(\Exception $e){
            return redirect()->back()->with('message', $e->getMessage());
        }
    }
}
