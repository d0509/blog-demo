<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class CategoryService
{

    protected $categoryObj;

    public function __construct()
    {
        $this->categoryObj = new Category();
    }

    public function collection($isForListing = false)
    {
        if ($isForListing == false) {
            $data = Category::select('id', 'name', 'is_active', 'slug');
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $editURL = route('admin.categories.edit', ['category' => $row->id]);
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
                    <div class="form-check form-switch text-center " >
                    <input class="form-check-input" type="checkbox" data-categoryId="' . $row->id . '"  role="switch" id="flexSwitchCheckChecked" ' . $condition . '>
                    <label class="form-check-label" for="flexSwitchCheckChecked"></label>
                    </div>';
                    return $switch;
                })
                ->rawColumns(['action', 'is_active', 'name'])
                ->setRowId('id')
                ->addIndexColumn()
                ->make(true);
        } else {
            $data = Category::select('slug','name')->where('is_active',1)->get();
            return $data;
            // dd($data->toArray());
        }
    }

    public function store($inputs)
    {
        $this->categoryObj->fill($inputs->except('slug'))->save();
        session()->flash('success', 'Category created successfully');
        return redirect()->route('admin.categories.index');
    }

    public function resource(string $id)
    {
        $category =  Category::findOrFail($id);
        return $category;
    }

    public function update($inputs, $id)
    {
        $category = Category::findOrFail($id);
        $category->update($inputs->except('slug'));
        $category->save();
        session()->flash('success',['message' => __('entity.entityUpdated', ['entity' => 'Category'])]);
        return redirect()->route('admin.categories.index');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        if ($category) {
            $category->delete();
        }
        session()->flash('success', __('entity.entityDeleted', ['entity' => 'Category']));
        return response()->json(['message' => __('entity.entityDeleted', ['entity' => 'Category'])]);
    }

    public function changeStatus($inputs)
    {
        $category = Category::whereId($inputs->id)->first();
        $updatedStatus = $category->is_active == 0 ? 1 : 0;
        $category->update([
            'is_active' => $updatedStatus,
        ]);

        return response()->json(['message' => __('entity.entityUpdated', ['entity' => 'Staus'])]);
    }

    
}
