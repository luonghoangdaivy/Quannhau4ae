<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        if (Auth::user()->role !== 'ADMIN') {
            return redirect('/')->with('error','Bạn không có quyền admin');
        }

        return $next($request);
    }
}
