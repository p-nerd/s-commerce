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
