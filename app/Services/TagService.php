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

    public function collection($isForListing = false)
    {
        if ($isForListing == false) {
            $data = $this->tagObj->select('id', 'name');
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $btn = '<div class="d-flex justify-content-space"><a style="margin-right: 8px;" class="text-white w-3 btn btn-danger mr-2" onclick="deleteTag(' . $row->id . ')" > <i class="fas fa-trash"></i></a></div>';
                    return $btn;
                })
                ->orderColumn('name', function ($query, $order) {
                    $query->orderBy('id', $order);
                })
                ->rawColumns(['action','name'])
                ->setRowId('id')
                ->addIndexColumn()
                ->make(true);
        } else {
            $data = $this->tagObj->select('name', 'id')->get();
            return $data;
        }
    }

    public function store($inputs)
    {
        $this->tagObj->fill($inputs)->save();
        toastr()->closeButton()->addSuccess(__('entity.entityCreated', ['entity' => 'Tag']));
        return redirect()->route('admin.tags.index');
    }

    public function destroy($id){
        $tags = $this->tagObj->findOrFail($id);
        if ($tags) {
            $tags->delete();
        }
        return response()->json(['message' => __('entity.entityDeleted', ['entity' => 'Tag'])]);
    }
}
