<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Post;
use Carbon\Carbon;
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

    public function collection($isForListing = false)
    {

        if (Auth::user() && Auth::user()->hasRole(config('site.roles.admin'))) {
            $data = Post::select('category_id', 'author', 'title', 'created_at', 'status', 'slug')
                ->with('category')
                ->whereHas('category', function ($q) {
                });
            if ($isForListing == false) {
                $data = Post::select("*")
                    ->with('category');
                return DataTables::of($data)
                    ->addColumn('action', function ($row) {
                        $editURL = route('admin.blogs.edit', ['blog' => $row->slug]);
                        $showURL = route('admin.blogs.show', ['blog' => $row->slug]);
                        $btn = '<div class="d-flex justify-content-between">
                        <a class="text-white w-3 btn btn-danger mr-2" onclick="deletePost(' . $row->id . ')" > <i class="fas fa-trash"></i></a>
                        <a style="margin-left:4px;" href="' . $showURL . '" class="text-white w-3 btn btn-primary delete_event mr-2"> <i class="fa-solid fa-eye"></i></a>
                        <a style="margin-left:4px;" href="' . $editURL . '" class="text-white w-3 btn btn-primary mr-2"> <i class="fa-solid fa-pen-to-square"></i></a>
                    </div>';
                        return $btn;
                    })
                    ->addColumn('created_at', function ($row) {
                        return Carbon::parse($row->created_at)->format(config('site.date_format'));
                    })
                    ->orderColumn('title', function ($query, $order) {
                        $query->orderBy('id', $order);
                    })
                    ->orderColumn('category_id', function ($query, $order) {
                        $query->orderBy('name', $order);
                    })
                    ->rawColumns(['action', 'title', 'created_at'])
                    ->setRowId('id')
                    ->addIndexColumn()
                    ->make(true);
            }
        } else {
            if (!empty(request('category_id')) && !empty(request('search'))) {
                if (request('search') == null && request('category_id') == 'empty') {
                    $blogs = Post::whereStatus('publish')->latest()->get();
                    return $blogs;
                } elseif (request('search') != null && request('category_id') != 'empty') {
                    $blogs = Post::where('title', 'like', '%' . request('search') . '%')->where('category_id', request('category_id'))->whereStatus('publish')->latest()->get();
                    return $blogs;
                } elseif (request('search') == null && request('category_id') != 'empty') {
                    $blogs = Post::whereCategoryId(request('category_id'))->whereStatus('publish')->latest()->get();
                    return $blogs;
                } elseif (!request('search') == null && request('category_id') == 'empty') {
                    $blogs = Post::where('title', 'like', '%' . request('search') . '%')->whereStatus('publish')->latest()->get();
                    return $blogs;
                } else {
                    $blogs = Post::whereStatus('publish')->latest()->get();
                    return $blogs;
                }
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
        if (!$blog) {
            return ['message' => "No post found"];
        }
        return $blog;
    }

    public function upsert($inputs, $slug = null)
    {
        // dd($slug);
        $post = $slug ? $this->postObj->whereSlug($slug)->first() : $this->postObj;

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
