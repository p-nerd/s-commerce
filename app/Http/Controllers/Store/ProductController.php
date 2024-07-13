<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->query(('per_page')) ?? 50;

        $filter = $request->query('filter') ?? 'featured';

        $query = Product::query()
            ->with('images');

        $query = match ($filter) {
            'featured' => $query->where('featured', true)->orderBy('created_at', 'desc'),
            'low-to-high' => $query->orderBy('discount_price', 'asc'),
            'high-to-low' => $query->orderBy('discount_price', 'desc'),
            'release-date' => $query->orderBy('released_date', 'desc'),
            'rating' => $query,
            default => $query,
        };

        $products = $query->paginate($perPage)
            ->withQueryString();

        $categories = Category::query()
            ->where('parent_id', null)
            ->where('featured', true)
            ->take(5)
            ->get();

        return match ($request->header('X-Type')) {
            'partial' => view('store/products/list', ['products' => $products]),
            default => view('store/products/index', [
                'products' => $products,
                'categories' => $categories,
            ])
        };
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
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
