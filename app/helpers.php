<?php

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
