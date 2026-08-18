<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    public function __construct(
        protected CategoryService $categoryService
    ) {
    }

    /**
     * Display a listing of the categories.
     */
    public function index()
    {
        $categories = $this->categoryService->getAll();

        return view(
            'pages.admin.categories.index',
            compact('categories')
        );
    }

    /**
     * Show the form for creating a new category.
     */
    public function create()
    {
        return view('pages.admin.categories.create');
    }

    /**
     * Store a newly created category.
     */
    public function store(StoreCategoryRequest $request)
    {
        $this->categoryService->create(
            $request->validated()
        );

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified category.
     */
    public function show(Category $category)
    {
        $category = $this->categoryService->find($category);

        return view(
            'pages.admin.categories.show',
            compact('category')
        );
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit(Category $category)
    {
        return view(
            'pages.admin.categories.edit',
            compact('category')
        );
    }

    /**
     * Update the specified category.
     */
    public function update(
        UpdateCategoryRequest $request,
        Category $category
    ) {
        $this->categoryService->update(
            $category,
            $request->validated()
        );

        return redirect()
            ->route('admin.category.index')
            ->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified category.
     */
    public function destroy(Category $category)
    {
        $this->categoryService->delete($category);

        return redirect()
            ->route('admin.category.index')
            ->with('success', 'Category deleted successfully.');
    }
}