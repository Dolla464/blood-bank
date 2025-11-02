<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class checkRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role)
    {
        $user = $request->user();
        
        if (!$user) {
            abort(403, 'Unauthorized action.');
        }
        
        if ($user->hasRole($role)) {
            return $next($request);
        }
        
        abort(403, 'Unauthorized action.');
    }
}