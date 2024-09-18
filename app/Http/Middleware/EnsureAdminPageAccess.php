<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class EnsureAdminPageAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()->account_type === 'Admin'){
            return $next($request);
        }
        else if (Auth::user()->account_type === 'Onboarding'){
            // Preboarding redirect is placeholder until a dashboard index is made.
            return redirect('/preboarding');
        }

        // No redirection back to index since the built in 'auth' middleware will handle it as long as it is applied to the router.
    }
}
