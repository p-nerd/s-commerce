<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        return view('store/home/index', [
            'featuredParentCategories' => Category::query()
                ->where('parent_id', null)
                ->where('featured', true)
                ->take(5)
                ->get(),
            'featuredSubCategories' => Category::query()
                ->where('parent_id', '!=', null)
                ->where('featured', true)
                ->get(),
            'featuredProducts' => Product::query()
                ->with('category')
                ->where('featured', true)
                ->get(),
        ]);
    }
}
