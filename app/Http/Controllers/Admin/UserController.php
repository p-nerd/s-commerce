<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query();

        $search = $request->query('search');
        if ($search) {
            $query->where('id', 'like', '%'.$search.'%');
            $query->orWhere('name', 'like', '%'.$search.'%');
            $query->orWhere('email', 'like', '%'.$search.'%');
        }

        $sortBy = $request->query('sort_by') ?? 'created_at';
        $order = $request->query('order') ?? 'desc';

        $query = $query->orderBy($sortBy, $order);

        $perPage = $request->query(('per_page')) ?? 10;
        $users = $query->paginate($perPage)->withQueryString();

        return view('admin/users/index', [
            'users' => $users,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
