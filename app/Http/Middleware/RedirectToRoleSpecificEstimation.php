<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectToRoleSpecificEstimation
{
    public function handle(Request $request, Closure $next)
    {
        // Jika admin, redirect ke gauss.form
        if (Auth::guard('admin')->check()) {
            return redirect()->route('gauss.form');
        }

        // Jika user biasa, redirect ke input.form
        if (Auth::check()) {
            return redirect()->route('input.form');
        }

        // Jika tidak login, redirect ke login
        return redirect()->route('login');
    }
}
