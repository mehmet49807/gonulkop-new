<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Kullanıcı giriş yapmış ve admin mi kontrol et
        if (Auth::check() && Auth::user()->isAdmin()) {
            return $next($request);
        }

        // Session tabanlı admin auth kontrolü (geriye uyumluluk için)
        if ($request->session()->get('admin_auth')) {
            return $next($request);
        }

        return redirect()->route('admin.login')->withErrors([
            'email' => 'Yönetici girişi gereklidir.',
        ]);
    }
}
