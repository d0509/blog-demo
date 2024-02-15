<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\Controller;

class UserStatusController extends Controller
{
    protected $userService;

    public function __construct()
    {
        $this->userService = new UserService;
    }

    public function __invoke(Request $request){
        return  $this->userService->changeStatus($request);
    }
}
