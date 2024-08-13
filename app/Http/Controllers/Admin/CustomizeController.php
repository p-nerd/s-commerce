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
        $flashes = $request
            ->collect()
            ->filter(fn ($_, $key) => preg_match('/^flash-\d+$/', $key))
            ->map(fn ($value) => trim($value))
            ->filter()
            ->values()
            ->all();

        // Validate each flash message
        $validator = Validator::make(
            ['flashes' => $flashes],
            ['flashes.*' => 'required|string|max:255']
        );

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        Option::setNewsFlashes($flashes);

        return redirect()
            ->back()
            ->with('success', 'News flashes updated successfully!');
    }

    public function updateHeroSliders(Request $request)
    {
        dd($request->all());
        //
    }
}
