<?php

namespace App\Services;

use App\Models\Category;
use Yajra\DataTables\Facades\DataTables;

class CategoryService
{

    protected $categoryObj;

    public function __construct()
    {
        $this->categoryObj = new Category();
    }

    public function collection($isDropdown = false)
    {
        $categories = $this->categoryObj->select('id', 'name', 'is_active', 'slug');
        if (!$isDropdown) {
            $data = DataTables::of($categories)
                ->addColumn('action', function ($row) {
                    $editURL = route('admin.categories.edit', ['category' => $row->slug]);
                    $btn = '<div class="d-flex justify-content-space"><a style="margin-right: 8px;" class="text-white w-3 btn btn-danger mr-2" onclick="deleteCategory(' . $row->id . ')" > <i class="fas fa-trash"></i></a><a href="' . $editURL . '" class="text-white  w-3 btn btn-primary mr-2"> <i class="fa-solid fa-pen-to-square"></i></a></div>';
                    return $btn;
                })
                ->orderColumn('name', function ($query, $order) {
                    $query->orderBy('id', $order);
                })
                ->addColumn('is_active', function ($row) {
                    $status  = $row->is_active;
                    $condition = $status == 1 ? 'checked' : '';
                    $switch = '
                    <div class="form-check form-switch text-center" >
                    <input class="form-check-input " style="cursor:pointer;" type="checkbox" data-categoryId="' . $row->id . '"  role="switch" id="flexSwitchCheckChecked" ' . $condition . '>
                    <label class="form-check-label" for="flexSwitchCheckChecked"></label>
                    </div>';
                    return $switch;
                })
                ->rawColumns(['action', 'is_active', 'name'])
                ->setRowId('id')
                ->addIndexColumn()
                ->make(true);
        } else {
            $data = $categories->where('is_active', 1)->get();
        }
        return $data;
    }

    public function store($inputs)
    {
        $this->categoryObj->fill($inputs->except('slug'))->save();
        toastr()->closeButton()->addSuccess(__('entity.entityCreated', ['entity' => 'Category']));
        return redirect()->route('admin.categories.index');
    }

    public function resource(string $slug)
    {
        $category =  $this->categoryObj->whereSlug($slug)->first();
        return $category;
    }

    public function update($inputs, $slug)
    {
        $category = $this->categoryObj->whereSlug($slug)->first();
        $category->update($inputs->except('slug'));
        $category->save();
        toastr()->closeButton()->addSuccess(__('entity.entityUpdated', ['entity' => 'Category']));
        return redirect()->route('admin.categories.index');
    }

    public function destroy($id)
    {
        $category = $this->categoryObj->findOrFail($id);
        if ($category) {
            $category->delete();
        }
        return response()->json(['message' => __('entity.entityDeleted', ['entity' => 'Category'])]);
    }

    public function changeStatus($inputs)
    {
        $category = $this->categoryObj->whereId($inputs->id)->first();
        $updatedStatus = $category->is_active == 0 ? 1 : 0;
        $category->update([
            'is_active' => $updatedStatus,
        ]);

        return response()->json(['message' => __('entity.entityUpdated', ['entity' => 'Status'])]);
    }
}
