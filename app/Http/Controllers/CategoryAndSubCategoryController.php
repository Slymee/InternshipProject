<?php

namespace App\Http\Controllers;

use App\Models\CategoryAndSubCategory;
use Illuminate\Http\Request;

class CategoryAndSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.adminCategory');
    }

    //Add Category Form
    public function addCategoryFormDisplay(){
        $datas = CategoryAndSubCategory::all();
        return view('modals.adminAddCategory', ['datas' => $datas]);
    }

    /**
     * Insert new category.
     */
    public function insertCategory(Request $request)
    {
        try{
            $request->validate([
                'category_name' => ['bail', 'required'],
                'parent_id' => ['nullable', 'exists:category_and_sub_categories,id'],
            ]);

            CategoryAndSubCategory::create([
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
    public function show(CategoryAndSubCategory $categoryAndSubCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CategoryAndSubCategory $categoryAndSubCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CategoryAndSubCategory $categoryAndSubCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoryAndSubCategory $categoryAndSubCategory)
    {
        //
    }
}
