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
        return view('modals.adminAddCategory');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
