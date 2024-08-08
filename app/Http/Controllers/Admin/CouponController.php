<?php

namespace App\Http\Controllers\Admin;

use App\Enums\CouponStatus;
use App\Enums\CouponType;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CouponController extends Controller
{
    public function index(Request $request)
    {
        $coupons = Coupon::query()
            ->when(
                $request->query('search'),
                function ($query, $search) {
                    $query->where(function ($subQuery) use ($search) {
                        $subQuery->where('id', 'like', '%'.$search.'%')
                            ->orWhere('code', 'like', '%'.$search.'%');
                    });
                }
            )
            ->orderBy(
                $request->query('sort_by', 'created_at'),
                $request->query('order', 'desc')
            )
            ->paginate(
                $request->query('per_page', 10)
            )
            ->withQueryString();

        return view('admin/coupons/index', [
            'coupons' => $coupons,
            'statuses' => CouponStatus::options(),
        ]);
    }

    public function create()
    {
        return view('admin/coupons/create', [
            'types' => CouponType::options(),
            'statuses' => CouponStatus::options(),
        ]);
    }

    public function store(Request $request)
    {
        $payload = $request->validate([
            'code' => ['required', 'string', 'unique:coupons,code'],
            'discount' => 'required', 'numeric', 'min:0',
            'type' => ['required', Rule::enum(CouponType::class)],
            'expires_at' => 'nullable', 'date', 'after:today',
            'status' => ['nullable', Rule::enum(CouponStatus::class)],
        ]);

        Coupon::create($payload);

        return to('admin.coupons', ['success' => 'Coupon saved successfully']);
    }

    public function show(Coupon $coupon)
    {
        return view('admin/coupons/show', [
            'coupon' => $coupon,
            'orders' => $coupon->orders,
            'statuses' => CouponStatus::options(),
        ]);
    }

    public function edit(Coupon $coupon)
    {
        return view('admin/coupons/edit', [
            'coupon' => $coupon,
            'types' => CouponType::options(),
            'statuses' => CouponStatus::options(),
        ]);
    }

    public function update(Request $request, Coupon $coupon)
    {
        $payload = $request->validate([
            'code' => ['nullable', 'string', Rule::unique('coupons')->ignore($coupon)],
            'discount' => ['nullable', 'numeric', 'min:0'],
            'type' => ['nullable', Rule::enum(CouponType::class)],
            'expires_at' => ['nullable', 'date', 'after:today'],
            'status' => ['nullable', Rule::enum(CouponStatus::class)],
        ]);

        $coupon->fill($payload)->save();

        return message(['success' => 'Coupon updated successfully']);
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();

        return message(['success' => 'Coupon deleted successfully']);
    }
}
