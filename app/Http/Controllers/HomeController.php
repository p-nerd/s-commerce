<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

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

    public function products()
    {
        $products = Product::query()
            ->with('images')
            ->paginate(request('per_page') ?? 50)
            ->withQueryString();

        return view('store/products', [
            'products' => $products,
        ]);
    }
}
