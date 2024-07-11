<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        return view('store/home', [
            'featuredParentCategories' => Category::query()->where('parent_id', null)->where('featured', true)->take(5)->get(),
            'featuredSubCategories' => Category::query()->where('parent_id', '!=', null)->where('featured', true)->get(),
        ]);
    }

    public function products()
    {
        return view('store/products', [
            'products' => Product::query()->paginate(50),
        ]);
    }
}
