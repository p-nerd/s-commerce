<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRole;
use App\Enums\UserStatus;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
        return view('admin/users/show', [
            'user' => $user,
            'orders' => $user->orders,
            'statuses' => UserStatus::options(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $payload = $request->validate([
            'role' => ['nullable', Rule::enum(UserRole::class)],
            'status' => ['nullable', Rule::enum(UserStatus::class)],
        ]);

        $user->fill($payload)->save();

        return go()->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return go()->with('success', 'User deleted successfully');
    }
}
