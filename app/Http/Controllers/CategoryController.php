<?php
declare(strict_types=1);

namespace App\Http\Controllers;


use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Repositories\Interfaces\AdminCategoryRepositoryInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    private $categoryRepository;

    public function __construct(AdminCategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $mainParent = $this->categoryRepository->getAll();
        return view('backend.admin-category', compact('mainParent'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Category $category): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $data = $this->categoryRepository->create();
        return view('backend.modals.admin-add-category', ['datas' => $data]);
    }

    /**
     *
     *
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request): RedirectResponse
    {
        try {
            $this->categoryRepository->store([
                'category_name' => $request->category_name,
                'parent_id' => $request->parent_id,
            ]);

            return redirect()->back()->with('message', 'Category Inserted.');
        } catch (\Exception $e) {
            Log::error('Caught Exception: ' . $e->getMessage());
            Log::error('Exception Details: ' . $e);
            return redirect()->back()->with('message', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $data = $this->categoryRepository->edit($id);

        return view('backend.modals.admin-edit-category', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request): RedirectResponse
    {
        return $this->categoryRepository->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        try {
            $this->categoryRepository->destroy($id);
            return redirect()->back()->with('message', 'Category Deleted');
        } catch (\Exception $e) {
            Log::error('Caught Exception: ' . $e->getMessage());
            Log::error('Exception details: ' . json_encode($e->getTrace(), JSON_PRETTY_PRINT));
            return redirect()->back()->with('message', $e->getMessage());
        }
    }

    /**
     * Getting paginated parent category
     * @param Category $category
     * @param Request $request
     * @return JsonResponse
     */
    public function getPaginatedCategory(Request $request): JsonResponse
    {
        $term = $request->term;
        return $this->categoryRepository->getPaginatedCategory($term);
    }

    /**
     * Getting paginated child category
     *
     * @param string $parentId
     * @return JsonResponse
     */
    public function displayChildCategory(string $parentId, Request $request): JsonResponse
    {
        $term = $request->term;
        $data = $this->categoryRepository->displayChildCategory($parentId, $term);
        return response()->json($data);
    }
}
