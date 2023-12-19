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
        $users = User::get();
        $userscount = $users->reject(function ($user, $key) {
            return $user->hasRole('admin');
        });
        return $userscount;
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
