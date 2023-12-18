<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use App\Services\PostService;
use Faker\Core\Blood;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $postService;
    protected $categoryService;

    public function __construct()
    {
        $this->postService = new PostService;
        $this->categoryService = new CategoryService;
    }

    public function index(Request $request)
    {
        $blogs = $this->postService->collection(true);
        $categories = $this->categoryService->collection(true);
        $category_id = request('category_id');
        return view('frontend.pages.home', [
            'blogs' => $blogs,
            'categories' => $categories,
            'category_id' => $category_id,
        ]);
    }

    public function getAjaxListing($request)
    {
        $blogs = $this->postService->collection(true);

        $htmlView = view('frontend.pages.blog-list', compact('blogs'))->render();

        return response()->json([
            'success' => true,
            'html' => $htmlView
        ]);
    }
}
