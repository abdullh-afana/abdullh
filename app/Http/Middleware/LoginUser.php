<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LoginUser
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        // 1. التأكد من أن المستخدم سجل دخول
        if (!auth()->check()) {
            return redirect('/login');
        }

        // 2. التحقق من رتبة المستخدم (admin أو student)
        // ملاحظة: يجب أن يكون لديك عمود اسمه role في جدول users
        if (auth()->user()->role !== $role) {
            
            // إذا كان أدمن يحاول دخول صفحة طالب أو العكس، وجهه للداشبورد الخاص به
            if (auth()->user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            
            return redirect('/dashboard')->with('error', 'ليس لديك صلاحية للدخول.');
        }

        return $next($request);
    }
}