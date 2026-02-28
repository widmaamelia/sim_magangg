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
   public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect('/login');
        }

        // 2. Ambil data user yang sedang login
        $user = Auth::user();

        // 3. Cek apakah role user ada di dalam daftar role yang diizinkan
        // Kita menggunakan in_array karena satu halaman bisa saja boleh diakses lebih dari satu role
        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        // 4. Jika tidak punya akses, lempar ke dashboard masing-masing atau beri error 403
        abort(403, 'Amelia, kamu tidak memiliki akses ke halaman ini!');
    }
}
