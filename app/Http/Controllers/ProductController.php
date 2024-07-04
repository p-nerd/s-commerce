<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $sortBy = $request->query('sort_by') ?? 'id';
        $order = $request->query('order') ?? 'desc';
        $perPage = $request->query(('per_page')) ?? 10;

        $query = Product::query()->with('category');

        if ($search) {
            $query->where('name', 'like', '%'.$search.'%');
        }

        if ($sortBy === 'category') {
            $query = $query->join('categories', 'categories.id', '=', 'products.category_id')
                ->orderBy('categories.name', $order)
                ->select('products.*');
        } else {
            $query = $query->orderBy($sortBy, $order);
        }

        $products = $query->paginate($perPage)->withQueryString();

        return view('dashboard/products/index', [
            'products' => $products,

        ]);
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
        $product->delete();

        return back()->with('success', 'Product deleted successfully.');
    }
}
