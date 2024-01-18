<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ProductAd;
use Illuminate\Http\Request;

class ProductAdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Category $category)
    {
        $mainParent = $category->whereNull('parent_id')->paginate(10);
        return view('userend.create-product', compact('mainParent'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductAd $productAd)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductAd $productAd)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductAd $productAd)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductAd $productAd)
    {
        //
    }
}
