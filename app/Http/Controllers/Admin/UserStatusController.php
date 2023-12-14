<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserStatusController extends Controller
{
    protected $userService;

    public function __construct()
    {
        $this->userService = new UserService;
    }

    public function __invoke(Request $request){
        $this->userService->changeStatus($request);
        return redirect()->route('admin.users.index');
    }
}
