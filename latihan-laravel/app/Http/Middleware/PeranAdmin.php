<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PeranAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user() === null || $request->user()->peran !== 'admin') {
            return response()->json([
                'sukses' => false,
                'pesan' => 'Akses ditolak: hanya administrator yang diizinkan',
            ], 403);
        }

        return $next($request);
    }
}
