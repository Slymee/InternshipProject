<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductAdRequest;
use App\Models\Category;
use App\Models\ProductAd;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductAdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $products = ProductAd::where('user_id', $user->id)->paginate(10);
        return view('userend.my-products', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Category $category)
    {
        $mainParent = $category->whereNull('parent_id')->paginate(10);
        return view('userend.create-product', compact('mainParent'));
    }

    /**
     * Getting paginated parent category
     */
    public function getPaginatedCategory(Category $category){
        $mainParent = $category->whereNull('parent_id')->get();
        return response()->json(['items' => $mainParent->items()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProductAdRequest $request)
    {
        try{
            $request['slug'] = Str::slug($request->input('product_title'));
            $imageName = 'solo' . time() . 'leveling' .'.'. $request->product_image->extension();

            if($imagePath = $request->file('product_image')->storeAs('images', $imageName, 'public')){
                $productAd=ProductAd::create([
                    'user_id' => $request->input('user_id'),
                    'product_title' => $request->input('product_title'),
                    'product_description' => $request->input('product_description'),
                    'product_price' => $request->input('product_price'),
                    'image_path' => $imagePath,
                    'slug' => $request['slug'],
                ]);
                $productAd->categories()->attach($request->input('parent_category'));
                $productAd->categories()->attach($request->input('sub_category'));
                $productAd->categories()->attach($request->input('sub_sub_category'));
                $tagNames = $request->input('product_tags', []); // Assuming 'product_tags' is an array in the request
                $productAd->tags()->saveMany(
                    array_map(function ($tagName) {
                        return new Tag(['tag_name' => $tagName]);
                    }, $tagNames)
                );
                return redirect()->back()->with('message', 'Product Add Success.');

            }
            return redirect()->back()->with('message', 'Product Add Failed.');

        }catch(\Exception $e){
            return redirect()->back()->with('message', $e->getMessage());
        }
    }

    /**
     * Select child category for selecting multilevel category
     */
    public function displayChildCategory(string $parentId){
        $data = Category::where('parent_id', $parentId)->paginate(10);
        return response()->json($data);
        // return response()->json(['items' => $data->items()]);
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductAd $productAd)
    {

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
