<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ProductType;
use App\Http\Controllers\Controller;
use App\Models\Category;
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

        $query = Product::with('category');

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
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
        return view('dashboard/products/create', [
            'types' => ProductType::options(),
            'categories' => Category::options(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $payload = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'short_description' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255'],
            'sku' => ['required', 'string', 'max:255'],
            'price' => ['required'],
            'discount_price' => ['nullable'],
            'manufactured_date' => ['required', 'date'],
            'expired_date' => ['required', 'date', 'after:manufactured_date'],
            'stock' => ['required', 'integer', 'min:0'],
            'category_id' => ['required', 'exists:categories,id'],
            'long_description' => ['nullable', 'string'],
        ]);

        Product::create([
            ...$payload,
            'slug' => Product::generateSlug($payload['name']),
        ]);

        return to_route('admin.products')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('dashboard/products/show', [
            'product' => $product,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('dashboard/products/edit', [
            'product' => $product,
            'types' => ProductType::options(),
            'categories' => Category::options(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $payload = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'short_description' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255'],
            'sku' => ['required', 'string', 'max:255'],
            'price' => ['required'],
            'discount_price' => ['nullable'],
            'manufactured_date' => ['required', 'date'],
            'expired_date' => ['required', 'date', 'after:manufactured_date'],
            'stock' => ['required', 'integer', 'min:0'],
            'category_id' => ['required', 'exists:categories,id'],
            'long_description' => ['nullable', 'string'],
        ]);

        $product->update($payload);

        return to_route('admin.products')->with('success', 'Product updated successfully.');
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
