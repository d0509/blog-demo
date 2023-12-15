<?php

namespace App\Services;

use App\Models\Post;
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

    public function collection()
    {
        $data = Post::select('id', 'category_id', 'author', 'title', 'created_at', 'status', 'slug')->with('category');
        return DataTables::of($data)
            ->addColumn('action', function ($row) {
                $editURL = route('admin.blogs.edit', ['blog' => $row->id]);
                $showURL = route('admin.blogs.show',['blog' => $row->id]);
                $btn = '<div class="d-flex justify-content-between"><a class="text-white w-3 btn btn-danger mr-2" onclick="deletePost(' . $row->id . ')" > <i class="fas fa-trash"></i></a><a href="' . $showURL . '" class="text-white w-3 btn btn-primary delete_event mr-2"> <i class="fa-solid fa-eye"></i></a><a href="' . $editURL . '" class="text-white w-3 btn btn-primary mr-2"> <i class="fa-solid fa-pen-to-square"></i></a></div>';
                return $btn;
            })
            ->orderColumn('title', function ($query, $order) {
                $query->orderBy('id', $order);
            })
            ->rawColumns(['action', 'title'])
            ->setRowId('id')
            ->addIndexColumn()
            ->make(true);
    }

    public function resource($id)
    {
        // dd($id);
        $blog = Post::findOrFail($id);
        return $blog;
    }

    public function upsert($inputs, $id = null)
    {
        $post = $id ? $this->postObj->find($id) : $this->postObj;

        $post->fill($inputs->except('old_banner'));
        $post->save();
        $message = $id ? __('entity.entityUpdated', ['entity' => 'Post']) : __('entity.entityCreated', ['entity' => 'Post']);

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

        // session()->flash('success', 'Category deleted successfully');
        return response()->json(['message' => 'Category deleted successfully']);
    }
}
