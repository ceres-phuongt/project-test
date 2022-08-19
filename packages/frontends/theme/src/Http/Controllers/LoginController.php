<?php

namespace Frontend\Theme\Http\Controllers;

use App\Http\Controllers\Controller;
use Backend\User\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('frontend/theme::theme.login');
    }

    public function login(LoginRequest $request)
    {
         $login = [
            'email' => $request->email,
            'password' => $request->password,
            'user_type' => 'member',
         ];

         if (Auth::guard('member')->attempt($login)) {
             return redirect()->route('frontend.homepage');
         } else {
             return redirect()->back()->with('error', 'Your username and password are wrong.');
         }
    }

    public function logOut()
    {
        Auth::guard('member')->logout();

        return redirect()->route('frontend.homepage');
    }
}
