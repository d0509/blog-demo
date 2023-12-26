<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\CategoryService;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $postService;
    protected $categoryService;
    
    public function __construct()
    {
        $this->postService = new PostService;
        $this->categoryService = new CategoryService;
    }

    public function show(Request $request){
        $post = $this->postService->resource(request('slug'));
        $categories = $this->categoryService->collection(true);

        $shareComponent = \Share::page(
            // 'https://www.positronx.io/create-autocomplete-search-in-laravel-with-typeahead-js/',.
            // 'https://packagist.org/packages/jorenvanhocht/laravel-share',
            // 'https://laravel.com/docs/10.x/socialite#installation',
            'https://www.addthis.com/',
            // url()->current(),
       )
       ->facebook()
       ->twitter()
       ->linkedin()
       ->telegram()
       ->whatsapp() 
       ->reddit();

    //    dd($shareComponent);

        // dd($categories);
        return view('frontend.pages.show-blog',[
            'post' => $post,
            'categories' => $categories,
            'shareComponent' => $shareComponent,
        ]);
    }
}
