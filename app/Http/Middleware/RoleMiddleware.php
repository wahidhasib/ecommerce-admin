<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with(['error' => 'You Must Login First']);
        }

        // Get logged in user
        $user = Auth::user();

        switch ($role) {
            case 'admin':
                if ($user->role !== 'admin') {
                    return redirect()->route('home')->with(['error' => 'Access Denied! Admins only.']);
                }
                break;

            case 'user':
                if ($user->role !== 'user') {
                    return redirect()->route('home')->with(['error' => 'Access Denied! Users only.']);
                }
                break;

            default:
                return redirect()->route('login')->with(['error' => 'Unauthorized Access!']);
        }

        return $next($request);
    }
}
