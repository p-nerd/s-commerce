<?php

use Illuminate\Support\Facades\Storage;

if (! function_exists('to')) {
    function to(?string $route = null, ?array $data = null)
    {
        $chan = redirect()->back();

        $redirect = request()->query('redirect');
        if ($redirect) {
            $chan = redirect($redirect);

        } elseif ($route) {
            $chan = redirect()->route($route);
        }

        return $chan->with($data);
    }
}

if (! function_exists('go')) {
    function go(?string $route = null, ?array $data = null)
    {
        return to($route, $data);
    }
}

if (! function_exists('message')) {
    function message(array $data = [])
    {
        if (request()->expectsJson()) {
            return response()->json($data);
        }

        return go()->with($data);
    }
}

if (! function_exists('get_first_number')) {
    /**
     * Get the first occurring number in a given string.
     */
    function get_first_number(string $input): ?string
    {
        if (preg_match('/\d+/', $input, $matches)) {
            return $matches[0];
        }

        return null; // Return null if no number is found
    }
}

if (! function_exists('public_image')) {
    function public_image(string $input): string
    {
        if (\Illuminate\Support\Str::isUrl($input)) {
            return $input;
        }
        if (str_starts_with($input, '/')) {
            return $input;
        }

        return Storage::disk('public')->url($input);
    }
}
