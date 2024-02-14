<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserStatusController;
use App\Http\Controllers\Admin\CategoryStatusController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\PostController as ControllersPostController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('auth')->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('users', UserController::class);
        Route::resource('tags',TagController::class);
        Route::post('change-status', UserStatusController::class)->name('change-status');
        Route::resource('categories', AdminCategoryController::class);
        Route::resource('blogs', AdminPostController::class);
        Route::post('categories/change-status', CategoryStatusController::class)->name('categories.status');
    });
});

Route::get('home', function () {
    return view('backend.pages.login');
});

Route::middleware('guest')->group(function () {
    Route::get('admin/login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'signIn'])->name('signIn');
    Route::get('register', [AuthController::class, 'register'])->name('register');
    Route::post('register', [AuthController::class, 'signUp'])->name('sign-up');
});

Route::get('blogs/{slug}', [ControllersPostController::class, 'show'])->name('posts.show');
Route::get('{category?}/{search?}', [HomeController::class, 'index'])->name('home');