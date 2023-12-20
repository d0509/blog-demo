<?php

namespace App\Services;

use App\Models\User;
use Yajra\DataTables\Facades\DataTables;

class UserService
{

    protected $userObj;

    public function __construct()
    {
        $this->userObj = new User();
    }

    public function collection()
    {
        $data = User::select(['id', 'first_name', 'last_name', 'email', 'mobile_no', 'status']);
        return DataTables::of($data)
            ->orderColumn('name', function ($query, $order) {
                $query->orderBy('id', $order);
            })
            ->rawColumns(['name'])
            ->setRowId('id')
            ->addIndexColumn()
            ->make(true);
    }

    public function changeStatus($inputs)
    {
        $user = User::findOrFail($inputs->userId);
        if ($user) {
            $user->update([
                'status' => $inputs->status
            ]);

            return response()->json(['message' => __('entity.entityUpdated', ['entity' => 'User'])]);
        }
    }
}
