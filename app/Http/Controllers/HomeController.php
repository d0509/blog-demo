<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $postService;

    public function __construct()
    {
        $this->postService = new PostService;
    }
    public function index(Request $request){
        $data = $this->postService->collection($request,true);
        return view('frontend.pages.home',[
            'blogs' => $data, 
        ]);
    }
}
