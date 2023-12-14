<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthService
{

    protected $userObj;

    public function __construct()
    {
        $this->userObj = new User();
    }

    public function signUp($inputs)
    {
        $user = $this->userObj->fill($inputs->except('status'));
        if ($user->exists()) {
            $user->assignRole(config('site.roles.user'));
            $user->status = config('site.user_status.pending');
            $user->save();
        }

        session()->flash('success', 'User registered successfully');
    }

    public function logout()
    {
        Auth::logout();
        $data['message'] = 'User logged out successfully';

        return $data;
    }

    public function signIn($inputs)
    {
        $user = User::whereEmail($inputs['email'])->exists();

        if ($user) {
            $user = User::whereEmail($inputs['email'])->first();
            if ($user->status == 'approved') {
                if (!Auth::attempt($inputs)) {
                    throw ValidationException::withMessages([
                        'email' => 'Your provided credentials could not be verified.'
                    ]);
                }
            } else {
                session()->flash('danger', 'You are not approved by the Admin. To login please contact admin');
            }
        } else {
            session()->flash('danger', 'User with such credential does not exist!');
        }

        
    }
}
