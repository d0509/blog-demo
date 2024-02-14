<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

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

       
        
        $blogs = Post::selectRaw("COUNT(*) as count")
        ->selectRaw("MONTHNAME(created_at) as month_name")
        ->selectRaw("MONTH(created_at) as month_number")
        ->whereYear('created_at', date('Y'))
        ->groupBy(DB::raw("MONTH(created_at)"), DB::raw("MONTHNAME(created_at)"))
        ->pluck('count', 'month_name');
        
        // Create an array with all months and set count to 0
        $months = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];
        
        // Merge the two arrays, replacing missing months with count 0
        $blogs = array_merge(array_fill_keys($months, 0), $blogs->toArray());

        $categories = Post::select('categories.name as category_name')
        ->selectRaw("COUNT(*) as count")
        ->join('categories', 'categories.id', '=', 'posts.category_id')
        ->groupBy('category_name')
        ->get();
        
        return view('backend.pages.home', [
            'usersCount' => $userscount,
            'categoryCount' => $categoryCount,
            'postCount' => $blogCount,
            'data' => $blogs,
            'categories' => $categories,
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
