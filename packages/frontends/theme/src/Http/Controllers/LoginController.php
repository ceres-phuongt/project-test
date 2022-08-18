<?php

namespace Frontend\Theme\Http\Controllers;

use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('frontend/theme::theme.login');
    }
}
