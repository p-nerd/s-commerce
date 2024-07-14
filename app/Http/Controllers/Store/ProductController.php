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
        $filter = $request->query('filter') ?? 'release-date';
        $categorySlug = $request->query('category');

        $query = Product::with('images');

        // category
        if ($categorySlug) {
            $category = Category::with('subCategories')->where('slug', $categorySlug)->first();
            if ($category) {
                $subCategoryIds = $category->subCategories->map(fn ($subCategory) => $subCategory->id);
                $subCategoryIds[] = $category->id;
                $query = $query->whereIn('category_id', $subCategoryIds);
            }
        }

        // filters with sort
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
            ->get()
            ->map(fn (Category $category) => [
                ...$category->toArray(),
                'productCount' => $category->productCounts()]
            )->sort(fn ($a, $b) => $b['productCount'] - $a['productCount']);

        return match ($request->header('X-Type')) {
            'partial' => view('store/products/products', [
                'products' => $products,
            ]),
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
