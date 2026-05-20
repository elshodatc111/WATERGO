<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckWebAccess{

    public function handle(Request $request, Closure $next): Response{
        if (!Auth::check()) {
            return redirect('/login');
        }
        $user = Auth::user();
        if (!$user->status) {
            Auth::logout();
            return redirect('/login')->withErrors(['phone' => 'Profilingiz bloklandi!']);
        }
        $allowedRoles = ['admin', 'drektor', 'operator'];
        if (!in_array($user->type, $allowedRoles)) {
            Auth::logout();
            return redirect('/login')->withErrors(['phone' => 'Ruxsat etilmagan foydalanuvchi!']);
        }
        return $next($request);
    }
    
}
