<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\TagService;
use App\Services\PostService;
use App\Services\CategoryService;
use App\Http\Requests\Post\Upsert;
use App\Http\Controllers\Controller;

class PostController extends Controller
{

    protected $postService, $categoryService, $tagService;

    public function __construct()
    {
        $this->postService = new PostService;
        $this->categoryService = new CategoryService;
        $this->tagService = new TagService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $posts =  $this->postService->collection();
            return $posts;
        }
        return view('backend.pages.blog.index');
    }

    public function create()
    {
        $category = $this->categoryService->collection(true);
        $tags = $this->tagService->collection(true);
        return view('backend.pages.blog.create', [
            'categories' => $category,
            'tags' => $tags,
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
        return view('backend.pages.blog.show', [
            'blog' => $data,
        ]);
    }

    public function edit(string $slug)
    {
        $category = $this->categoryService->collection(true);
        $data = $this->postService->resource($slug);
        $tags = $this->tagService->collection(true);
        return view('backend.pages.blog.create', [
            'blog' => $data,
            'categories' => $category,
            'tags' => $tags,        
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Upsert $request, string $id)
    {
        $this->postService->upsert($request, $id);
        return redirect()->route('admin.blogs.index');
    }

    public function destroy($post)
    {
        return $this->postService->destroy($post);
    }
}
