<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tag\Create;
use App\Models\Tag;
use App\Services\TagService;
use Illuminate\Http\Request;

class TagController extends Controller
{
    protected $tagService;

    public function __construct()
    {
        $this->tagService = new TagService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->tagService->collection();
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
    public function store(Create $request)
    {
        return $this->tagService->store($request->validated());
    }

    /** 
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        return $this->tagService->destroy($tag->id);
    }
}