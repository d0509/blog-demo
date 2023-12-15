<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Plank\Mediable\Facades\MediaUploader;
use Plank\Mediable\Media;
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
                $data = Post::select("*")
                ->with('category');
                return DataTables::of($data)
                    ->addColumn('action', function ($row) {
                        $editURL = route('admin.blogs.edit', ['blog' => $row->id]);
                        $showURL = route('admin.blogs.show', ['blog' => $row->id]);
                        $btn = '<div class="d-flex justify-content-between">
                        <a class="text-white w-3 btn btn-danger mr-2" onclick="deletePost(' . $row->id . ')" > <i class="fas fa-trash"></i></a>
                        <a style="margin-left:4px;" href="' . $showURL . '" class="text-white w-3 btn btn-primary delete_event mr-2"> <i class="fa-solid fa-eye"></i></a>
                        <a style="margin-left:4px;" href="' . $editURL . '" class="text-white w-3 btn btn-primary mr-2"> <i class="fa-solid fa-pen-to-square"></i></a>
                    </div>';
                        return $btn;
                    })
                    ->orderColumn('title', function ($query, $order) {
                        $query->orderBy('id', $order);
                    })
                    ->orderColumn('category_id', function ($query, $order) {
                        $query->orderBy('name', $order);
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
            if (request('search')) {
                $blogs = Post::whereStatus('publish')->Search(request('search'))->latest()->get();
                return $blogs;
            } else {
                $blogs = Post::whereStatus('publish')->latest()->get();
                return $blogs;
            }
        }
    }

    public function resource($slug)
    {
        // dd($slug);
        $blog = Post::whereSlug($slug)->first();
        if(!$blog)
        {
            return ['message' => "No post found"];
        }
        return $blog;
    }

    public function upsert($inputs, $slug = null)
    {
        $post = $slug ? $this->postObj->where('slug', $slug)->first() : $this->postObj;

        $post->fill($inputs->except('old_banner'));
        $post->save();
        $message = $slug ? __('entity.entityUpdated', ['entity' => 'Post']) : __('entity.entityCreated', ['entity' => 'Post']);

        $this->handleImageUpload($inputs, $post);
        session()->flash('success', $message);
        return $post;
    }

    public function handleImageUpload($request, $post)
    {
        if ($request->hasFile('banner')) {
            $file = $request->file('banner');
            $newFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $imageUploader = MediaUploader::fromSource($file)->useFilename($newFileName);

            if ($oldImage = $post->firstMedia('banner')) {
                $imageUploader->replace($oldImage);
                $post->syncMedia($oldImage, 'banner');
            } else {

                $post->attachMedia($imageUploader->toDestination('public', 'banner')->upload(), 'banner');
            }
        }
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $postBannerImage = $post->firstMedia('banner');
        if ($post) {
            $post->delete();
            $postBannerImage->delete();
        }
        return response()->json(['message' => 'Category deleted successfully']);
    }
}
