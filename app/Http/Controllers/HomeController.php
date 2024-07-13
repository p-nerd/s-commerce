<?php

namespace App\Http\Controllers;

use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        return view('store/home', [
            'featuredParentCategories' => Category::query()
                ->where('parent_id', null)
                ->where('featured', true)
                ->take(5)
                ->get(),
            'featuredSubCategories' => Category::query()
                ->where('parent_id', '!=', null)
                ->where('featured', true)
                ->get(),
        ]);
    }
}
