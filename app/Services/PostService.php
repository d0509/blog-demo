<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Plank\Mediable\Facades\MediaUploader;
use Yajra\DataTables\Facades\DataTables;

class PostService
{

    protected $postObj;

    public function __construct()
    {
        $this->postObj = new Post();
    }

    public function collection($inputs, $isForListing = false)
    {
        if (Auth::user() && Auth::user()->hasRole(config('site.roles.admin'))) {
            if ($isForListing == false) {
                $data = Post::select('id', 'category_id', 'author', 'title', 'created_at', 'status', 'slug')->with('category');
                return DataTables::of($data)
                    ->addColumn('action', function ($row) {
                        $editURL = route('admin.blogs.edit', ['blog' => $row->id]);
                        $showURL = route('admin.blogs.show', ['blog' => $row->id]);
                        $btn = '<div class="d-flex justify-content-space"><a class="text-white w-3 btn btn-danger mr-2" onclick="deletePost(' . $row->id . ')" > <i class="fas fa-trash"></i></a><a href="' . $showURL . '" class="text-white w-3 btn btn-primary delete_event mr-2"> <i class="fa-solid fa-eye"></i></a><a href="' . $editURL . '" class="text-white w-3 btn btn-primary mr-2"> <i class="fa-solid fa-pen-to-square"></i></a></div>';
                        return $btn;
                    })
                    ->orderColumn('title', function ($query, $order) {
                        $query->orderBy('id', $order);
                    })
                    ->rawColumns(['action', 'title'])
                    ->setRowId('id')
                    ->addIndexColumn()
                    ->make(true);
            } else {
                $blog = Post::with('media')->latest()->get();
                return $blog;
            }
        } else {
            $keyword = $inputs->input('keyword');
            if (isset($keyword)) {
                $posts = Post::with('media')->whereStatus('publish')->search($keyword)->get();
                return response()->json(['message' => $posts]);
            } else {
                $posts = Post::with('media')->whereStatus('publish')->get();
                return response()->json(['message' => $posts]);
            }
        }
    }

    public function resource($id)
    {
        $blog = Post::findOrFail($id);
        return $blog;
    }

    public function store($inputs)
    {
        $post = $this->postObj->fill($inputs->validated());
        $post->save();

        $media = MediaUploader::fromSource($inputs->file('banner'))
            ->toDisk('public')
            ->toDirectory('banner')
            ->upload();

        $post->attachMedia($media, 'banner');
        session()->flash('success', 'Blog created successfully');
        return $post;
    }
}
