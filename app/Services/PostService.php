<?php

namespace App\Services;

use App\Models\Post;
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
        $data = Post::select('id','category_id', 'author', 'title', 'created_at', 'status', 'slug')->with('category');
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

    public function resource($id){
        // dd($id);
        $blog = Post::findOrFail($id);
        return $blog;
    }

    public function upsert($inputs, $id = null)
    {
        // $post = $this->postObj->fill($inputs->validated());
        // $post->save();
        // session()->flash('success', 'Blog created successfully');
        // return $post;

        $category = $id ? $this->postObj->find($id) : $this->postObj;
        
        $category->fill($inputs->all())->save();

        $message = $id ?  __('entity.entityUpdated', ['entity' => 'Post']) :  __('entity.entityCreated', ['entity' => 'Post']);
        $response = ['message' => $message];
        return $response;
    }

}
