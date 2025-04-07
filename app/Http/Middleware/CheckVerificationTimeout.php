<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class CheckVerificationTimeout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Session::has('verification_expires_at')) {
           
            if (now()->lt(Session::get('verification_expires_at'))) {
                return redirect()->route('email.verify');
            }
            
            Session::forget(['verification_expires_at']);
        }

        return $next($request);
    }
}
