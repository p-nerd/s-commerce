<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
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

        $query = Category::query()->with('subCategories')->where('parent_id', null);

        if ($search) {
            $query->where('name', 'like', '%'.$search.'%');
        }

        $categories = $query
            ->orderBy($sortBy, $order)
            ->paginate($perPage)
            ->withQueryString();

        return view('admin/categories/index', [
            'categories' => $categories,
        ]);
    }

    public function subCategories(Request $request, Category $category)
    {
        $search = $request->query('search');
        $sortBy = $request->query('sort_by') ?? 'id';
        $order = $request->query('order') ?? 'desc';
        $perPage = $request->query(('per_page')) ?? 10;

        $query = $category->subCategories()->with('subCategories');

        if ($search) {
            $query->where('name', 'like', '%'.$search.'%');
        }

        $categories = $query
            ->orderBy($sortBy, $order)
            ->paginate($perPage)
            ->withQueryString();

        return view('admin/categories/index', [
            'category' => $category,
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin/categories/create', [
            'categories' => Category::parentOptions(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $payload = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'parent_id' => ['nullable', 'exists:categories,id'],
        ]);

        Category::create([
            ...$payload,
            'slug' => Category::generateSlug($payload['name']),
        ]);

        return to_route('admin.categories')->with(['success' => 'Category created.']);
    }

    public function show(Category $category)
    {
        $parent = $category->parent;
        $subCategories = $category->subCategories;

        return view('admin/categories/show', [
            'category' => $category,
            'parent' => $parent,
            'subCategories' => $subCategories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function edit(Category $category)
    {
        return view('admin/categories/edit', [
            'category' => $category,
            'categories' => Category::parentOptions(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $payload = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'parent_id' => ['nullable', 'exists:categories,id'],
        ]);

        $category->update($payload);

        return to_route('admin.categories')->with(['success' => 'Category updated.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return to_route('admin.categories')->with(['success' => 'Category deleted.']);
    }
}
