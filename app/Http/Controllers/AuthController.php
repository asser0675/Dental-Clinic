<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $r)
    {
        $credentials = $r->validate(['email' => 'required|email', 'password' => 'required|string']);
        if (! Auth::attempt($credentials, $r->boolean('remember'))) {
            return back()->withErrors(['email' => 'Email or password is incorrect. Check your credentials and try again.'])->onlyInput('email');
        }
        $r->session()->regenerate();

        return redirect()->route('workspace');
    }

    public function logout(Request $r)
    {
        Auth::logout();
        $r->session()->invalidate();
        $r->session()->regenerateToken();

        return redirect()->route('login');
    }
}
