<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\ProductEditUpdateRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Faker\Core\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Input;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $user = auth()->user();
        $products = Product::where('user_id', $user->id)->paginate(10);
        return view('userend.my-products', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Category $category): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $mainParent = $category->whereNull('parent_id')->paginate(10);
        return view('userend.create-product', compact('mainParent'));
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
        $mainParent = $category->where('category_name','like','%'.$term.'%')->whereNull('parent_id')->paginate(2);
        return response()->json(['items' => $mainParent->items()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProductRequest $request): \Illuminate\Http\RedirectResponse
    {
        try{
            $request['slug'] = Str::slug($request->input('product_title'));
            $imageName = 'solo' . time() . 'leveling' .'.'. $request->product_image->extension();

            if($imagePath = $request->file('product_image')->storeAs('images', $imageName, 'public')){
                $productAd=Product::create([
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
                $tagNames = $request->input('product_tags', []);
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
     * Getting paginated child category
     *
     * @param string $parentId
     * @return \Illuminate\Http\JsonResponse
     */
    public function displayChildCategory(string $parentId, Request $request): \Illuminate\Http\JsonResponse
    {
        $term = $request->term;
        $data = Category::where('category_name', 'like', '%'.$term.'%')->where('parent_id', $parentId)->paginate(2);
        return response()->json(['items' => $data->items()]);
        // return response()->json(['items' => $data->items()]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $productAd)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $productAd, string $productId): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
//        $mainParent = Category::whereNull('parent_id')->paginate(10);
        $productDetails = $productAd->with('categories', 'tags')->find($productId);
        return view('userend.edit-product', compact('productDetails'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateProductRequest $request, string $productId): \Illuminate\Http\RedirectResponse
    {
        try {
            $product = Product::findOrFail($productId);
            $imagePath = $product->image_path;
//        dd($request->all());

            if ($request->hasFile('product_image')){
                if ($product->product_image){
                    Storage::delete($product->product_image);
                }
                $imageName = 'solo' . time() . 'leveling' .'.'. $request->product_image->extension();
                $imagePath = $request->file('product_image')->storeAs('images', $imageName, 'public');
            }

            $product->update([
                'product_title' => $request->product_title,
                'product_description' => $request->product_description,
                'product_price' => $request->product_price,
                'image_path' => $imagePath
            ]);

            $categories = [];
            $categories = array_merge($categories, (array)$request->input('parent_category'));
            $categories = array_merge($categories, (array)$request->sub_category);
            $categories = array_merge($categories, (array)$request->sub_sub_category);
            $product->categories()->sync($categories);


            if ($request->has('product_tags')) {
                $product->tags()->delete();
//                dd($request->input('product_tags', []));
                foreach ($request->input('product_tags', []) as $productTag){
                    $tag = new Tag(['tag_name' => $productTag]);
                    $product->tags()->save($tag);
                }
            }
            return redirect()->back()->with('message', 'Product Updated!');
        }catch (\Exception $e){
            return redirect()->back()->with('message', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $productId): \Illuminate\Http\RedirectResponse
    {
        try {
            $product = Product::find($productId);
//            $imagePath = public_path().'/'.$product->image_path;
            Storage::disk('public')->delete($product->image_path);
            $product->delete();
            return redirect()->back()->with('message', 'Product Deleted');
        }catch (\Exception $e){
            return redirect()->back()->with('message', $e->getMessage());
        }
    }
}
