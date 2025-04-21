<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed',
        ]);

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Registration successful! Please login');
        
    }



    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            $user = Auth::user();

            return redirect()->intended(
                match($user->role){
                    'admin' => route('admin.dashboard'),
                    'blogger' => route('blogger.dashboard'),
                    default => route('commenter.dashboard')
                }
            );

            
            
        }

        return back()->withErrors([
            'email' => 'Invalid credentials!',
        ])->onlyInput('email');

        
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate(); // data remove here
        $request->session()->regenerate(); // csrf regenerate

        return redirect('/login')->with('warning', 'You have been logged out.');
    }

    
}
