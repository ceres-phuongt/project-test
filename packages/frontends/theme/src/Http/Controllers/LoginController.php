<?php

namespace Frontend\Theme\Http\Controllers;

use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('frontend/theme::theme.login');
    }

    public function login(LoginRequest $request)
    {
         $login = [
            'email' => $request->txtEmail,
            'password' => $request->txtPassword,
            'user_type' => 'member',
         ];

         if (Auth::guard('member')->attempt($login)) {
             return redirect()->route('frontend.index');
         } else {
             return redirect()->back()->with('error', 'Your username and password are wrong.');
         }
    }

    public function logOut()
    {
        Auth::guard('member')->logout();

        return redirect()->route('frontend.index');
    }
}
