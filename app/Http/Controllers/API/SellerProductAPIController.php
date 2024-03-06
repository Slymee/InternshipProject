<?php
declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductRequest;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SellerProductAPIController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Foundation\Application|Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
     * @throws \Exception
     */
    public function index(Request $request): \Illuminate\Foundation\Application|Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        try {
            $user = auth()->user();
            $products = Product::with('category')->where('user_id', $user->id)->paginate(10);
            return Response(['status' => '200', 'products' => $products], 200);
        }catch (\Exception $e){
            Log::error('Caught Exception: '. $e);
            throw $e;
        }
    }

    /**
     * Store a newly created resources in storage
     * @param CreateProductRequest $request
     * @return \Illuminate\Foundation\Application|Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
     * @throws \Exception
     */
    public function store(CreateProductRequest $request): \Illuminate\Foundation\Application|Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
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
                    'category_id' => $request->sub_sub_category,
                ]);


                $tagIds = [];
                foreach ($request->input('product_tags') as $tagName){
                    $tag = Tag::firstOrCreate(['tag_name' => $tagName]);
                    $tagIds[] = $tag->id;
                }
                $productAd->tags()->sync($tagIds);
                return Response(['status' => 200, 'message' => 'Product Insert Success.'], 201);

            }
            return Response(['message' => 'Product Add Failed'], 500);

        }catch(\Exception $e){
            Log::error('Caught Exception: ' . $e->getMessage());
            Log::error('Exception Details: ' . $e);
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Update the specified resource in storage.
     * @param CreateProductRequest $request
     * @param string $productId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|Response
     */
    public function update(CreateProductRequest $request, string $productId): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|Response
    {
        try {
            $product = Product::findOrFail($productId);
            $imagePath = $product->image_path;

            if ($product){
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
                    'category_id' => $request->sub_sub_category,
                    'image_path' => $imagePath
                ]);

                $tagIds = [];
                foreach ($request->input('product_tags') as $tagName){
                    $tag = Tag::firstOrCreate(['tag_name' => $tagName]);
                    $tagIds[] = $tag->id;
                }
                $product->tags()->sync($tagIds);

                return Response(['status' => 200, 'message' => 'Product Update Success.'], 201);
            }
            return Response(['message' => 'Product Update Failed'], 500);
        }catch (\Exception $e){
            Log::error('Caught Exception: ' . $e->getMessage());
            Log::error('Exception Details: ' . $e);
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param string $productId
     * @return Response
     */
    public function destroy(int $productId): Response
    {
        try {
            $product = Product::find($productId);
            Storage::disk('public')->delete($product->image_path);
            $product->delete();
            return Response(['message' => 'Product Deleted.'], 200);
        }catch (\Exception $e){
            Log::error('Caught Exception: ' . $e->getMessage());
            Log::error('Exception Details: ' . $e);
            DB::rollBack();
            throw $e;
        }
    }
}
