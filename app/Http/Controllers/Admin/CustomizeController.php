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
        $data = $request->validate([
            'hero-sliders' => 'required|array',
            'hero-sliders.*.heading1' => 'required|string|max:255',
            'hero-sliders.*.heading2' => 'required|string|max:255',
            'hero-sliders.*.subheading' => 'required|string|max:255',
            'hero-sliders.*.image' => 'nullable|image|max:2048', // Validation for image upload
        ]);

        $heroSliders = [];

        foreach ($data['hero-sliders'] as $index => $slider) {
            // Handle image upload
            if ($request->hasFile("hero-slider-{$index}-image")) {
                $imagePath = $request->file("hero-slider-{$index}-image")->store('hero-sliders', 'public');
                $slider['image'] = $imagePath;
            }

            $heroSliders[] = $slider;
        }

        dd($heroSliders);

        // Save or update hero sliders in the database or any other storage
        // Assuming you have a model to save these, e.g., HeroSlider::updateOrCreate(...)
        // Example:
        // HeroSlider::updateOrCreate(['id' => $id], $slider);

        return redirect()->back()->with('success', 'Hero sliders updated successfully.');
    }
}
