<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryFormValidator;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mainParent = Category::whereNull('parent_id')->paginate(10);
        return view('backend.adminCategory', compact('mainParent'));
    }

    //Add Category Form

    /**
     * @Aashish
     * 
     * instead of wrting custom function like this, try to use laravel resource controller defined functions
     * resource controller provides predefiend functions like "index, store, update, edit, destroy"
     * 
     */
    public function addCategoryFormDisplay(){
        $datas = Category::whereNull('parent_id')
        ->orWhereHas('parent', fn ($query) => $query->whereNull('parent_id'))
        ->get();
        
        return view('backend.modals.adminAddCategory', ['datas' => $datas]);
    }

    /**
     * Insert new category.
     */
    public function insertCategory(CategoryFormValidator $request)
    {
        try{
            /**
             * @Aashish
             * 
             * Use form request here. Use controller to handle request only.
             * ---------------fixed--------------
             */
            $request->validate();

            Category::create([
                'category_name' => $request->validated()['category_name'],
                'parent_id' => $request->validated()['parent_id'],
            ]);

            return redirect()->back()->with('message', 'Insert Success.');

        }catch(\Exception $e){
            return redirect()->back()->with('message', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($category_id)
    {
        try{
            $editableData = Category::select('id', 'category_name','parent_id')->findOrFail($category_id);
            $datas = Category::whereNull('parent_id')
            ->orWhereHas('parent', fn ($query) => $query->whereNull('parent_id'))
            ->get();
            return view('backend.modals.adminEditCategory', ['editableData' => $editableData],
                                                            ['datas' => $datas]);
        }catch(\Exception $e){

        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryFormValidator $request)
    {
        try{
            /**
             * @Aashish
             * 
             * Use form request 
             * remove below validation code
             * ------------fixed------------
             */


            /**
             * @Aashish
             * 
             * Instead of quering or find here use route model binding. "Search for route model binding in laravel"
             * 
             */
            $category = Category::find($request->input('category_id'));

            /**
             * @Aashish
             * 
             * why use update and save both? 
             * 
             * either use update or save. 
             * ---------------fixed-------------------
             */
            $category->update($request->validated());
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
            /**
             * @Aashish
             * 
             * RecursiveDelete deletes its related childs
             * 
             * but remove this instead try to delete using relationship defined in model
             */
            Category::find($category_id)->recursiveDelete();
            return redirect()->back()->with('message', 'Category Deleted');
        }catch(\Exception $e){
            return redirect()->back()->with('message', $e->getMessage());
        }
    }
}
