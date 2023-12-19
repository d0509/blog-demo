<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        $userscount = $users->reject(function ($user, $key) {
            return $user->hasRole('admin');
        })->count();

        $categoryCount = Category::count();

        $blogCount = Post::count();

        return view('backend.pages.home',[
            'usersCount' => $userscount,
            'categoryCount' => $categoryCount,
            'postCount' => $blogCount,
        ]);

    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
