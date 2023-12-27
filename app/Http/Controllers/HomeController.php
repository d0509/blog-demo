<?php

namespace App\Http\Controllers;

use App\Jobs\LatestBlogsMail;
use App\Mail\SendLatestBlogs;
use App\Models\Post;
use App\Services\CategoryService;
use App\Services\PostService;
use Barryvdh\DomPDF\Facade\Pdf;
use Faker\Core\Blood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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

        // $blogs = Post::with('media')->latest()->take(2)->get();

        // if($blogs->count() > 0)
        // { 
        //     $pdf = PDF::loadView('pdf.latest-blog-pdf', compact('blogs'));
        //     $pdfName = 'blog_' . now()->timestamp . '.pdf';
            
        //     $pdf->save(public_path() . '\storage\posts' . $pdfName);
        //     $pdfPath = public_path() . '\storage\posts' . $pdfName;
            
        //     try {
        //         LatestBlogsMail::dispatch($blogs, $pdfPath);
        //     } catch (\Exception $e) {
        //         Log::error('PDF generation error: ' . $e->getMessage());

        //     }
        //     // $this->info('Success');
        // }
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
