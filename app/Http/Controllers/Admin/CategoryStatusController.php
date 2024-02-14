<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Http\Controllers\Controller;

class CategoryStatusController extends Controller
{
    protected $categoryService;

    public function __construct(){
        $this->categoryService = new CategoryService;
    }

    public function __invoke(Request $request)
    {
       return $this->categoryService->changeStatus($request);
    }
}
