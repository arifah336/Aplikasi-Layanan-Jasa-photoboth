<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email'
        ]);

        // Cari user berdasarkan username
        $user = \App\Models\User::where('username', $request->username)->first();

        // Cocokkan email sebagai 'password'
        if ($user && $user->email === $request->email) {
            \Auth::login($user);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['username' => 'Username atau email tidak cocok.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/admin/login');
    }
}