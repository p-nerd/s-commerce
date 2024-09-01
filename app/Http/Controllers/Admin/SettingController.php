<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function deliveryCharge(Request $request)
    {
        $allDistricts = Location::query()
            ->with('division')
            ->whereNotNull('division_id')
            ->get();

        $divisionsConfig = collect(config('settings.divisions'))
            ->map(function ($division) use ($allDistricts) {
                $division['districts'] = collect($division['districts'])
                    ->filter(fn ($district) => ! collect($allDistricts)->first(fn ($d) => $district['value'] === $d['value']))
                    ->values()
                    ->toArray();

                return $division;
            })
            ->filter(fn ($division) => ! collect($division['districts'])->isEmpty())
            ->values()
            ->toArray();

        $districts = Location::query()
            ->with('division')
            ->whereNotNull('division_id')
            ->when(
                $request->query('search'),
                fn ($q, $s) => $q
                    ->where('value', 'like', '%'.$s.'%')
                    ->orWhere('label', 'like', '%'.$s.'%')
            )
            ->paginate($request->query('per_page') ?? 10);

        return view('admin/settings/delivery-charge', [
            'divisionsConfig' => $divisionsConfig,
            'districts' => $districts,
        ]);
    }

    public function deliveryChargeStore(Request $request)
    {
        $payload = $request->validate([
            'division' => ['required', 'string'],
            'district' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
        ]);

        $division = Location::query()
            ->where('value', $payload['division'])
            ->where('division_id', null)
            ->first();

        $district = Location::query()
            ->where('value', $payload['district'])
            ->where('division_id', '!=', null)
            ->first();

        if ($district) {
            return to(data: ['success' => 'District already exist']);
        }

        $division->districts()->create([
            'value' => $payload['district'],
            'label' => ucwords($payload['district']),
            'price' => $payload['price'],
        ]);

        return to(data: ['success' => 'District added successfully.']);
    }

    public function deliveryChargeUpdate(Request $request)
    {
        $payload = $request->validate([
            'district_id' => ['required', 'integer', 'exists:locations,id'],
            'price' => ['required', 'numeric', 'min:0'],
        ]);

        $district = Location::findOrFail($payload['district_id']);
        $district->update(['price' => $payload['price']]);

        return to(data: ['success' => 'Delivery charge updated successfully.']);
    }
}
