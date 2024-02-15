<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Plank\Mediable\Facades\MediaUploader;

class PostService
{

    protected $postObj;

    public function __construct()
    {
        $this->postObj = new Post();
    }

    public function collection($isForListing = false)
    {
        $query =$this->postObj->select("*")->with('category');

        if (Auth::user() && Auth::user()->hasRole(config('site.roles.admin'))) {
            $query->whereHas('category', function ($q) {
                $q->where('deleted_at', null);
            });

            if (!$isForListing) {
                return $this->adminDataTable($query);
            } else {
                return $this->userListing($query);
            }
        } else {
            return $this->userListing($query);
        }
    }

    protected function adminDataTable($query)
    {
        $data = $query->orderBy('id', 'desc');

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
            ->rawColumns(['action', 'title', 'created_at', 'category_id'])
            ->setRowId('id')
            ->addIndexColumn()
            ->make(true);
    }

    protected function userListing($query)
    {
        $query = $this->postObj->select("*")->with('category')->whereStatus('publish');
        if (request('q')) {
            $blogs = $query->Search(request('qp'))->latest()->get();
            return $blogs;
        } elseif (request('category')) {
            $blogs = $query->InCategory(request('category'))->latest()->get();
            return $blogs;
        } else {
            $query =$this->postObj->select("*")->with('category');
            $blogs = $this->postObj->with('category')
                ->where('status', 'publish')
                ->whereHas('category', function ($query) {
                    $query->where('is_active', 1);
                })
                ->latest('created_at')
                ->get();
            return $blogs;
        }
    }

    public function resource($slug)
    {
        $blog = $this->postObj->whereSlug($slug)->first();
        if (!$blog) {
            return ['message' => "No Blogs found"];
        }
        return $blog;
    }

    public function upsert($inputs, $slug = null)
    {
        $post = $slug ? $this->postObj->whereSlug($slug)->first() : $this->postObj;

        $post->fill($inputs->except('old_banner'));
        $post->save();

        $tags = $inputs->get('tags');
        $post->tags()->sync($tags);

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
        $post = $this->postObj->findOrFail($id);
        $postBannerImage = $post->firstMedia('banner');
        if ($post) {
            $postBannerImage->delete();
            $post->tags()->detach();
            $post->delete();
        }
        return response()->json(['message' => 'Blog deleted successfully']);
    }
}
