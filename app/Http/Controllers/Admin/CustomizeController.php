<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomizeController extends Controller
{
    public function index()
    {
        return view('admin/settings/customize/index', [
            'newsFlashes' => Option::newsFlashes(),
            'heroSliders' => Option::heroSliders(),
        ]);
    }

    public function updateNewsFlashes(Request $request)
    {
        $flashes = $request->collect()
            ->filter(fn ($_, $key) => preg_match('/^flash-\d+$/', $key))
            ->map(fn ($value) => trim($value))
            ->filter();

        $validator = Validator::make(
            ['flashes' => $flashes->toArray()],
            ['flashes.*' => 'required|string|max:255']
        );

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        Option::setNewsFlashes($flashes->values()->all());

        return back()->with('success', 'News flashes updated successfully!');
    }

    public function updateHeroSliders(Request $request)
    {
        $sliders = [];

        foreach ($request->all() as $key => $value) {
            $number = get_first_number($key);

            if (str_contains($key, 'new-image') && $request->hasFile($key)) {
                $sliders[$number]['image'] = $request->file($key)->store('hero-sliders', 'public');
            } elseif (str_contains($key, 'image')) {
                $sliders[$number]['image'] = $value;
            } elseif (str_contains($key, 'heading1')) {
                $sliders[$number]['heading1'] = $value;
            } elseif (str_contains($key, 'heading2')) {
                $sliders[$number]['heading2'] = $value;
            } elseif (str_contains($key, 'subheading')) {
                $sliders[$number]['subheading'] = $value;
            }
        }

        Option::setHeroSliders($sliders);

        return redirect()->back()->with('success', 'Hero sliders updated successfully.');
    }
}
