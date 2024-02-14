<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return view('userend.index');
        }catch(\Exception $e){
            dd($e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Category $category)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProductRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $products, string $productID)
    {
        $product = $products->find($productID)->load('category');
        return view('userend.product-page', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $productAd, string $productId)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateProductRequest $request, string $productId)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $productId)
    {

    }

    /**
     * List products acording to category
     * @param string $categoryId
     * @return \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function categoryProductList(string $categoryId): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {

        $products = Product::where('category_id', $categoryId)->paginate(10);
        $categoryName = Category::find($categoryId)->category_name;
        return view('userend.product-list', compact('categoryName' , 'products'));
    }
}
