<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $postService;
    
    public function __construct()
    {
        $this->postService = new PostService;
    }

    public function show($slug){

        $post = $this->postService->resource($slug);
        return view('frontend.pages.show-blog',[
            'post' => $post
        ]);
    }
}
