<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleAccess
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect('/login');
        }

        $path = $request->path(); // ambil path URL, misal "admin", "dosen", ""

        // ROLE: ADMIN
        if ($user->role === 'admin') {
            if (!str_starts_with($path, 'admin')) {
                return redirect('/admin');
            }
        }

        // ROLE: DOSEN
        if ($user->role === 'dosen') {
            if (!str_starts_with($path, 'dosen')) {
                return redirect('/dosen');
            }
        }

        // ROLE: MAHASISWA
        if ($user->role === 'mahasiswa') {
            if (str_starts_with($path, 'admin') || str_starts_with($path, 'dosen')) {
                return redirect('/quiz-login');
            }
        }

        return $next($request);
    }
}
