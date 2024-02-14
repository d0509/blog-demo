<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Services\TagService;
use Illuminate\Http\Request;
use App\Http\Requests\Tag\create;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    
    protected $tagService;

    public function __construct()
    {
        $this->tagService = new TagService;
    }

    public function index(Request $request)
    {
        if($request->ajax()){
            $posts =  $this->tagService->collection();
            return $posts;
        }
        return view('backend.pages.tag.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(create $request)
    {
        return $this->tagService->store($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        return $this->tagService->destroy($tag->id);
    }
}
