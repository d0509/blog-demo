<?php

namespace App\Services;

use App\Models\Tag;
use Yajra\DataTables\Facades\DataTables;

class TagService
{
    protected $tagObj;

    public function __construct()
    {
        $this->tagObj = new Tag();
    }

    public function collection($dropdownTagList = false)
    {
        $tagsQuery = Tag::select('id', 'name');

        if ($dropdownTagList) {
            return $tagsQuery->get();
        }
        return DataTables::of($tagsQuery)
            ->addColumn('action', function ($tag) {
                $btn = '<div class="d-flex justify-content-space"><a style="margin-right: 8px;" class="text-white w-3 btn btn-danger mr-2" onclick="deleteTag(' . $tag->id . ')" > <i class="fas fa-trash"></i></a></div>';
                return $btn;
            })
            ->orderColumn('name', function ($query, $order) {
                $query->orderBy('id', $order);
            })
            ->rawColumns(['name', 'action'])
            ->setRowId('id')
            ->addIndexColumn()
            ->make(true);
    }

    public function store($inputs)
    {
        $this->tagObj->fill($inputs)->save();
        toastr()->closeButton()->addSuccess(__('entity.entityCreated', ['entity' => 'Tag']));
        return redirect()->route('admin.tags.index');
    }

    public function destroy($tag)
    {
        $tag->delete();
        return response()->json(['message' => __('entity.entityDeleted', ['entity' => 'Tag'])]);
    }
}
