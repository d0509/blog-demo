<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\Create;
use App\Models\Category;
use App\Services\CategoryService as CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct()
    {
        $this->categoryService = new CategoryService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $companies =  $this->categoryService->collection();
            return $companies;
        }
        return view('backend.pages.category.index');
    }

    public function create()
    {
        return view('backend.pages.category.create');
    }

    public function store(Create $request)
    {
        return $this->categoryService->store($request);
    }

    public function edit(String $slug)
    {
        $data = $this->categoryService->resource($slug);
        return view('backend.pages.category.create', [
            'category' => $data,
        ]);
    }

    public function update(Create $request, string $slug)
    {
        return $this->categoryService->update($request, $slug);
    }

    public function destroy(Category $category)
    {
        return $this->categoryService->destroy($category->id);
    }
}
