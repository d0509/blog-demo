<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Login;
use App\Http\Requests\Auth\Register;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $authService;

    public function __construct()
    {
        $this->authService = new AuthService;
    }

    public function login()
    {
        return view('backend.pages.login');
    }

    public function signIn(Login $request)
    {
       return $this->authService->signIn($request->validated());
        // if (Auth::user()->hasRole(config('site.roles.admin'))) {
        //     return redirect()->route('admin.dashboard');
        // } elseif (Auth::user()->hasRole(config('site.roles.user'))) {
        //     return redirect()->route('home');
        // }
    }

    public function register()
    {
        return view('backend.pages.register');
    }

    public function signUp(Register $request)
    {
        $this->authService->signUp($request);
        return redirect()->back();
    }

    public function logout()
    {
        $this->authService->logout();
        return redirect()->route('login');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
