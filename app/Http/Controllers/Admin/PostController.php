<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\PostService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\Upsert;
use App\Services\CategoryService;

class PostController extends Controller
{

    protected $postService,$categoryService;

    public function __construct()
    {
        $this->postService = new PostService;
        $this->categoryService = new CategoryService;
    }

    public function index(Request $request)
    {
        if($request->ajax()){
            $posts =  $this->postService->collection();
            return $posts;
        }
        return view('backend.pages.blog.index');
    }

    public function create()
    {
        $category = $this->categoryService->collection(true);
        return view('backend.pages.blog.create',[
            'categories' => $category
            ]);
    }

    public function store(Upsert $request)
    {
       $this->postService->upsert($request);
       return redirect()->route('admin.blogs.index');
    }

    public function show(String $slug)
    {
        $data = $this->postService->resource($slug);
        return view('backend.pages.blog.show',[
            'blog' => $data,
        ]);
    }

    public function edit(string $slug)
    {
        $category = $this->categoryService->collection(true);
        $data = $this->postService->resource($slug);
        return view('backend.pages.blog.create',[
            'blog' => $data,
            'categories' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Upsert $request, string $id)
    {
        $this->postService->upsert($request,$id);
        return redirect()->route('admin.blogs.index');
    
    }

    public function destroy($post)
    {
        return $this->postService->destroy($post);
    }
}
