<?php

namespace App\Http\Controllers;

use App\Models\Pustakawan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
{
    $request->validate([
        'username' => 'required',
        'password' => 'required',
    ]);

    $credentials = $request->only('username', 'password');
    $remember = $request->has('remember');  // Check if remember me is checked

    if (Auth::guard('web')->attempt($credentials, $remember)) {
        $request->session()->regenerate();
        return redirect()->intended('/');
    }

    return back()->withErrors([
        'error' => 'The provided credentials do not match our records.',
    ])->onlyInput('username');
}
    public function logout(Request $request)
    {
        Auth::logout();  // Log out the user

        $request->session()->invalidate();  // Invalidate the session
        $request->session()->regenerateToken();  // Regenerate the session token

        return redirect('/login')->with('message', 'You have been successfully logged out.');  // Redirect with a success message
    }
}
