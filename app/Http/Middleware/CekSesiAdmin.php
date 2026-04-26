<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/*
|--------------------------------------------------------------------------
| Middleware: CekSesiAdmin
|--------------------------------------------------------------------------
| Middleware ini melindungi rute-rute yang hanya boleh diakses admin.
| Caranya: mengecek apakah session 'admin_login' bernilai true.
| Jika belum login, request akan ditolak dengan response JSON 403.
|--------------------------------------------------------------------------
|
| Cara mendaftarkan middleware ini:
| Di file app/Http/Kernel.php, tambahkan di bagian $routeMiddleware:
|
|   'auth.admin' => \App\Http\Middleware\CekSesiAdmin::class,
|
*/

class CekSesiAdmin
{
    /**
     * Menangani request yang masuk.
     * Cek apakah admin sudah login (ada di session).
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek session admin
        if (!$request->session()->get('admin_login', false)) {
            // Jika request AJAX/JSON, kembalikan error JSON
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'gagal',
                    'pesan'  => 'Akses ditolak. Silakan login sebagai admin terlebih dahulu.',
                ], 403);
            }

            // Jika request biasa, redirect ke halaman beranda
            return redirect()->route('beranda')
                ->with('pesan_error', 'Silakan login sebagai admin terlebih dahulu.');
        }

        return $next($request);
    }
}