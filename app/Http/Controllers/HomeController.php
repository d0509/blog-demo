<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use Faker\Core\Blood;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $postService;

    public function __construct()
    {
        $this->postService = new PostService;
    }
    public function index(Request $request)
    {
        $blogs = $this->postService->collection($request, true);
        // dd($blogs);
        return view('frontend.pages.home', [
            'blogs' => $blogs
        ]);
    }

    public function getAjaxListing($request)
    {
        $blogs = $this->postService->collection($request, true);

        $htmlView = view('frontend.pages.blog-list', compact('blogs'))->render();

        return response()->json([
            'success' => true,
            'html' => $htmlView
        ]);
    }
}
