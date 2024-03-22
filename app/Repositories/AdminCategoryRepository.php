<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Interfaces\AdminCategoryRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class AdminCategoryRepository implements AdminCategoryRepositoryInterface
{
    public function getAll()
    {
        return Category::whereNull('parent_id')->paginate(10);
    }

    public function create()
    {
        $data = Category::whereNull('parent_id')
            ->orWhereHas('parent', fn ($query) => $query->whereNull('parent_id'))
            ->paginate(10);
        return $data;
    }

    public function store(array $data)
    {
        try {
            DB::beginTransaction();
            Category::create([
                'category_name' => $data['category_name'],
                'parent_id' => $data['parent_id'],
            ]);

            DB::commit();

            return ['status' => 200, 'message' => 'Category Inserted.'];
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Caught Exception: ' . $e->getMessage());
            Log::error('Exception Details: ' . $e);
            throw $e;
        }
    }

    public function edit(string $categoryId): array
    {
        $editableData = Category::select('id', 'category_name', 'parent_id')->findOrFail($categoryId);
        $data = Category::whereNull('parent_id')
            ->orWhereHas('parent', fn ($query) => $query->whereNull('parent_id'))
            ->paginate(10);

        return ['editableData' => $editableData, 'datas' => $data];
    }

    public function update(array $data): \Illuminate\Http\RedirectResponse
    {
        try {
            $updateData = [
                'category_name' => $data['category_name'],
            ];

            if (isset($data['parent_id'])) {
                $updateData['parent_id'] = $data['parent_id'];
            }
            DB::beginTransaction();
            Category::where('id', $data['category_id'])->update($updateData);
            DB::commit();

            return redirect()->back()->with('message', 'Edit Success!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Caught Exception: ' . $e->getMessage());
            Log::error('Exception details: ' . $e);
            return redirect()->back()->with('message', $e->getMessage());
        }
    }

    public function destroy(string $categoryId)
    {
        Category::find($categoryId)->delete();
    }

    public function getPaginatedCategory(string $term): \Illuminate\Http\JsonResponse
    {
        $mainParent = Category::where('category_name', 'like', '%' . $term . '%')
            ->whereNull('parent_id')
            ->paginate(10);

        return response()->json(['items' => $mainParent->items()]);
    }

    public function displayChildCategory(string $parentId, string $term): array
    {
        $data = Category::where('category_name', 'like', '%' . $term . '%')
            ->where('parent_id', $parentId)
            ->paginate(10);
        return ['items' => $data->items()];
    }
}
