<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function deliveryCharge()
    {
        $divisionsConfig = config('settings.divisions');

        $divisionsOptions = [];
        foreach ($divisionsConfig as $key => $division) {
            $divisionsOptions[] = [
                'value' => $key,
                'label' => ucwords($key),
            ];
        }

        $districts = Location::query()
            ->with('division')
            ->where('division_id', '!=', null)->paginate(10);

        return view('admin/settings/delivery-charge', [
            'divisionsConfig' => $divisionsConfig,
            'divisionsOptions' => $divisionsOptions,
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
