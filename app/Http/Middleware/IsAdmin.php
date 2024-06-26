<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()->role == "admin"){
         return $next($request);
        } else {
            return redirect('/home')->with('failed', 'Anda bukan admin & tidak memiliki akses halaman tersebut!');
        }
    }
}
