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
    /**
     * Display a listing of the resource.
     */
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin/coupons/create', [
            'types' => CouponType::options(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $payload = $request->validate([
            'code' => ['required', 'string', 'unique:coupons,code'],
            'discount' => 'required', 'numeric', 'min:0',
            'type' => ['required', Rule::enum(CouponType::class)],
            'expires_at' => 'nullable', 'date', 'after:today',
        ]);

        Coupon::create($payload);

        return redirect()
            ->route('admin.coupons.index')
            ->with(['success' => 'Coupon saved successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Coupon $coupon)
    {
        return view('admin/coupons/show', [
            'coupon' => $coupon,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coupon $coupon)
    {
        return view('admin/coupons/edit', [
            'coupon' => $coupon,
            'types' => CouponType::options(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Coupon $coupon)
    {
        $payload = $request->validate([
            'code' => ['required', 'string', Rule::unique('coupons')->ignore($coupon)],
            'discount' => ['required', 'numeric', 'min:0'],
            'type' => ['required', Rule::enum(CouponType::class)],
            'expires_at' => ['nullable', 'date', 'after:today'],
        ]);

        $coupon->update($payload);

        return redirect()
            ->back()
            ->with(['success' => 'Coupon updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();

        return message(['success' => 'Coupon deleted successfully']);
    }
}
