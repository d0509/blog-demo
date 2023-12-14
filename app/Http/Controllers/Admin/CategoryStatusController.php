<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryStatusController extends Controller
{
    protected $categoryService;

    public function __construct(){
        $this->categoryService = new CategoryService;
    }

    public function __invoke(Request $request)
    {
        $this->categoryService->changeStatus($request);
    }
}
