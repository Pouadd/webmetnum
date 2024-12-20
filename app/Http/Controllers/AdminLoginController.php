<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login'); 
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
    
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('home'); // Redirect ke halaman home
        }
    
        return back()->withErrors(['username' => 'Invalid credentials']);
    }

    public function logout(Request $request)
    {
        // Logout admin
        Auth::guard('admin')->logout();

        // Redirect ke halaman home
        return redirect()->route('home')->with('success', 'You have successfully logged out.');
    }

    
    
}
