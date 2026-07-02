<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserStatus
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && !Auth::user()->status) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            // Usar Toastr en lugar de session flash
            return redirect()->route('login')->with('toastr', [
                'type' => 'error',
                'message' => 'Tu cuenta está inactiva. Contacta al administrador.'
            ]);
        }
        
        return $next($request);
    }
}