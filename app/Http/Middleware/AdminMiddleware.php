<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Session::get('USER_LOGIN')) {
            return redirect('/')->with('error', 'You must be logged in to access this page.');
        }

        // $userId = Session::get('USER_ID');
        // $user = User::find($userId);
            
        return $next($request);
    }
}
