<?php

namespace App\Http\Controllers;

use App\Mail\SendLatestBlogs;
use App\Models\Post;
use App\Services\CategoryService;
use App\Services\PostService;
use Barryvdh\DomPDF\Facade\Pdf;
use Faker\Core\Blood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

        // $blogs = $this->postService->collection(true);
        // $categories = $this->categoryService->collection(true);
        $blogs = Post::with(['media' => function ($query) {
            $query->latest()->first();
        }])->latest()->take(2)->get();

        Mail::to("admin@gmail.com")->send(new SendLatestBlogs($blogs));   

        // try {
            
        //     // $pdf = PDF::loadView('pdf.latest-blog-pdf', compact('blogs'));
        //     // return $pdf->download('myorders.pdf');
        //     return view('pdf.latest-blog-pdf',compact('blogs'));

        // } catch (\Exception $e) {
        //     \Log::error('PDF generation error: ' . $e->getMessage());
        //     // Handle the error appropriately, e.g., return a response to the user
        // }
        
        // $category_id = request('category_id');
        // return view('frontend.pages.home', [
        //     'blogs' => $blogs,
        //     'categories' => $categories,
        //     'category_id' => $category_id,
        // ]);
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
