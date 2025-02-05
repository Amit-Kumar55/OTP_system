<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class HandleLivewireRequests
{
    public function handle(Request $request, Closure $next): Response
    {
        // Ensure authentication persists in Livewire
        if (Auth::check()) {
            Auth::setUser(Auth::user());
        }

        return $next($request);
    }
}
