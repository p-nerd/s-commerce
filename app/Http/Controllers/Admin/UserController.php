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
            'statuses' => UserStatus::options(),
        ]);
    }

    public function show(User $user)
    {
        return view('admin/users/show', [
            'user' => $user,
            'orders' => $user->orders,
            'statuses' => UserStatus::options(),
        ]);
    }

    public function update(Request $request, User $user)
    {
        $payload = $request->validate([
            'role' => ['nullable', Rule::enum(UserRole::class)],
            'status' => ['nullable', Rule::enum(UserStatus::class)],
        ]);

        $user->fill($payload)->save();

        return response()->json(['success' => 'User updated successfully']);
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return go()->with('success', 'User deleted successfully');
    }
}
