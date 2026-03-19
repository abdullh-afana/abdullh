<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * التعديل هنا يجعل التوجيه يعتمد على الرتبة (Role)
     */
    public function handle(Request $request, Closure $next, string ...$guards)
{
    $guards = empty($guards) ? [null] : $guards;

    foreach ($guards as $guard) {
        if (Auth::guard($guard)->check()) {
            $user = Auth::user();

            // فحص الرتبة وتوجيه مباشر للمسار
            if ($user->hasRole('admin')) {
                return redirect('/admin/dashboard');
            } 
            
            if ($user->hasRole('student')) {
                return redirect('/student/dashboard');
            }
        }
    }

    return $next($request);
}
}