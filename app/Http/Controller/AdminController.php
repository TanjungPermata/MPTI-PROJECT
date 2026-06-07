<?php

namespace App\Http\Controller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/*
|--------------------------------------------------------------------------
| AdminController - Gurau Tenda Palembang
|--------------------------------------------------------------------------
| Controller ini menangani semua keperluan admin:
| - Login & logout admin
| - Menyimpan/mengubah status ketersediaan kamar kost
|--------------------------------------------------------------------------
*/

class AdminController extends Controller
{
    /**
     * Proses login admin.
     * Menerima username dan password dari form modal di halaman beranda.
     * Jika benar, simpan status login di session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        // Validasi input wajib ada
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Ambil kredensial dari konfigurasi (lihat: config/admin.php)
        $usernameBenar = config('admin.username', 'admin');
        $passwordBenar = config('admin.password', '123palembang');

        if (
            $request->input('username') === $usernameBenar &&
            $request->input('password') === $passwordBenar
        ) {
            // Simpan status admin login di session
            $request->session()->put('admin_login', true);

            return response()->json([
                'status' => 'berhasil',
                'pesan'  => 'Login berhasil! Selamat datang, Admin.',
            ]);
        }

        // Login gagal
        return response()->json([
            'status' => 'gagal',
            'pesan'  => 'Username atau password salah.',
        ], 401);
    }

    /**
     * Logout admin.
     * Menghapus data sesi login admin.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $request->session()->forget('admin_login');

        return response()->json([
            'status' => 'berhasil',
            'pesan'  => 'Anda telah logout.',
        ]);
    }

    /**
     * Menyimpan data ketersediaan kamar yang diubah admin.
     * Data dikirim dari panel admin di halaman beranda via AJAX (fetch).
     * Data disimpan di session agar bisa diakses oleh BerandaController.
     *
     * Catatan: Untuk produksi, sebaiknya simpan ke database (tabel 'ketersediaan_kamar').
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function simpanStatus(Request $request)
    {
        // Validasi: data harus berupa array
        $request->validate([
            'data' => 'required|array',
        ]);

        $datamasuk = $request->input('data');

        // Format ulang data masuk agar konsisten
        // Data dari JavaScript: { "Januari 2026": { "avail": true, "rooms": 3 } }
        // Format disimpan:      { "Januari 2026": { "tersedia": true, "jumlah_kamar": 3 } }
        $dataFormatted = [];
        foreach ($datamasuk as $bulan => $info) {
            $dataFormatted[$bulan] = [
                'tersedia'     => (bool) ($info['avail'] ?? false),
                'jumlah_kamar' => (int)  ($info['rooms'] ?? 0),
            ];
        }

        // Simpan ke session
        $request->session()->put('data_ketersediaan_kamar', $dataFormatted);

        return response()->json([
            'status' => 'berhasil',
            'pesan'  => 'Data ketersediaan kamar berhasil disimpan!',
        ]);
    }
}