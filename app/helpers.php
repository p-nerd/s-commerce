<?php

if (! function_exists('go')) {
    function go()
    {
        $redirect = request()->query('redirect');
        if (! $redirect) {
            return redirect()->back();
        }

        return redirect($redirect);
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
