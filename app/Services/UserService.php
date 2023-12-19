<?php

namespace App\Services;

use App\Models\User;

class UserService
{

    protected $userObj;

    public function __construct()
    {
        $this->userObj = new User();
    }

    public function collection()
    {
        $user = User::latest()->get();
        return $user;
    }

    public function changeStatus($inputs)
    {
        $user = User::findOrFail($inputs->userId);
        if ($user) {
            $user->update([
                'status' => $inputs->status
            ]);
        }

        return response()->json(['message' => __('entity.entityUpdated', ['entity' => 'User'])]);
    }
}
