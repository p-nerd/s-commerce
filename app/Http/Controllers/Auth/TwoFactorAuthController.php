<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class TwoFactorAuthController extends Controller
{
    public function index()
    {
        return view('auth/two-factor-auth');
    }
}
