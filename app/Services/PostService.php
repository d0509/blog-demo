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

            if ($isForListing == false) {
                $data = Post::select("*")
                    ->with('category')->whereHas('category', function ($q) {
                        $q->where('deleted_at', null);
                    });
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
                    ->rawColumns(['action', 'title', 'created_at','category_id'])
                    ->setRowId('id')
                    ->addIndexColumn()
                    ->make(true);
            } else {
                $query = Post::select("*")->with('category');
                if (request('search')) {
                    $blogs = $query->Search(request('search'))->whereStatus('publish')->latest()->get();
                    return $blogs;
                } elseif (request('category')) {

                    $blogs = $query->InCategory(request('category'))->whereStatus('publish')->latest()->get();
                    // dd($blogs);
                    return $blogs;
                } else {
                    $query = Post::select("*")->with('category');
                    $blogs = Post::with('category')
                        ->where('status', 'publish')
                        ->whereHas('category', function ($query) {
                            $query->where('is_active', 1);
                        })
                        ->latest('created_at')
                        ->get();
                    return $blogs;
                }
            }
        } else {
            // if (request('category_id') && request('category_id') != 'empty') {
            //     $blogs = Post::whereCategoryId(request('category_id'))->whereStatus('publish')->latest()->get();
            //     return $blogs;
            // }    
            $query = Post::select("*")->with('category');
            if (request('search')) {
                $blogs = $query->Search(request('search'))->whereStatus('publish')->latest()->get();
                return $blogs;
            } elseif (request('category')) {


                // $blogs = $query->where()
                $blogs = $query->InCategory(request('category'))->whereStatus('publish')->latest()->get();
                // dd($blogs);
                return $blogs;
            } else {
                $query = Post::select("*")->with('category');
                $blogs = Post::with('category')
                    ->where('status', 'publish')
                    ->whereHas('category', function ($query) {
                        $query->where('is_active', 1);
                    })
                    ->latest('created_at')
                    ->get();
                return $blogs;
            }
            // if(request('category'))
        }
    }

    public function resource($slug)
    {
        $blog = Post::whereSlug($slug)->first();
        if (!$blog) {
            return ['message' => "No Blogs found"];
        }
        return $blog;
    }

    public function upsert($inputs, $slug = null)
    {
        // dd($slug);
        $post = $slug ? $this->postObj->whereSlug($slug)->first() : $this->postObj;

        $post->fill($inputs->except('old_banner'));
        $post->save();
        $message = $slug ? __('entity.entityUpdated', ['entity' => 'Blog']) : __('entity.entityCreated', ['entity' => 'Blog']);

        $this->handleImageUpload($inputs, $post);
        toastr()->closeButton()->addSuccess($message);
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
        return response()->json(['message' => 'Blog deleted successfully']);
    }
}
