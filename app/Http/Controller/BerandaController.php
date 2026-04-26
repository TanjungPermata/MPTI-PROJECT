<?php

namespace App\Http\Controller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
/*
|--------------------------------------------------------------------------
| BerandaController - Gurau Tenda Palembang
|--------------------------------------------------------------------------
| Controller ini menangani halaman utama website Gurau Tenda.
| Berisi logika untuk menampilkan data dan mengecek ketersediaan kamar kost.
|--------------------------------------------------------------------------
*/

class BerandaController extends Controller
{
    /**
     * Menampilkan halaman beranda utama.
     * Mengambil data ketersediaan kamar dari database/session
     * lalu dikirim ke view Blade.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Ambil data ketersediaan kamar yang disimpan admin
        // Jika belum ada di database, gunakan data default (semua penuh)
        $dataKamar = $this->ambilDataKamar();

        // Kirim data ke view beranda
        return view('beranda', compact('dataKamar'));
    }

    /**
     * Mengecek ketersediaan kamar berdasarkan bulan yang dipilih pengunjung.
     * Dipanggil via AJAX dari halaman beranda (tombol "Cek Ketersediaan").
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function cekKetersediaan(Request $request)
    {
        // Validasi: bulan wajib diisi
        $request->validate([
            'bulan' => 'required|string'
        ]);

        $bulan = $request->input('bulan');
        $dataKamar = $this->ambilDataKamar();

        // Cek apakah bulan yang diminta ada di data
        if (!isset($dataKamar[$bulan])) {
            return response()->json([
                'status' => 'error',
                'pesan'  => 'Bulan tidak valid.'
            ], 422);
        }

        $info = $dataKamar[$bulan];

        return response()->json([
            'status'    => 'ok',
            'tersedia'  => $info['tersedia'],
            'jumlahKamar' => $info['jumlah_kamar'],
            'bulan'     => $bulan,
        ]);
    }

    /**
     * Mengambil data ketersediaan kamar.
     * Data diambil dari session (disimpan oleh admin melalui AdminController).
     * Jika belum ada, kembalikan data default (semua penuh, 0 kamar).
     *
     * @return array
     */
    private function ambilDataKamar(): array
    {
        // Coba ambil dari session terlebih dahulu
        if (session()->has('data_ketersediaan_kamar')) {
            return session('data_ketersediaan_kamar');
        }

        // Data default: semua bulan penuh
        return [
            'Januari 2026'   => ['tersedia' => false, 'jumlah_kamar' => 0],
            'Februari 2026'  => ['tersedia' => false, 'jumlah_kamar' => 0],
            'Maret 2026'     => ['tersedia' => false, 'jumlah_kamar' => 0],
            'April 2026'     => ['tersedia' => false, 'jumlah_kamar' => 0],
            'Mei 2026'       => ['tersedia' => false, 'jumlah_kamar' => 0],
            'Juni 2026'      => ['tersedia' => false, 'jumlah_kamar' => 0],
            'Juli 2026'      => ['tersedia' => false, 'jumlah_kamar' => 0],
            'Agustus 2026'   => ['tersedia' => false, 'jumlah_kamar' => 0],
            'September 2026' => ['tersedia' => false, 'jumlah_kamar' => 0],
            'Oktober 2026'   => ['tersedia' => false, 'jumlah_kamar' => 0],
            'November 2026'  => ['tersedia' => false, 'jumlah_kamar' => 0],
            'Desember 2026'  => ['tersedia' => false, 'jumlah_kamar' => 0],
        ];
    }
}