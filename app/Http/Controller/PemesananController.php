<?php

namespace App\Http\Controller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\HistoryPemesanan;

/*
|--------------------------------------------------------------------------
| PemesananController — VERSI UPDATE
|--------------------------------------------------------------------------
| Letakkan di: app/Http/Controller/PemesananController.php (timpa yang lama)
|--------------------------------------------------------------------------
*/

class PemesananController extends Controller
{
    /**
     * Menyimpan data pemesanan baru ke database.
     */
    public function simpan(Request $request)
    {
        $request->validate([
            'jenis_tenda'    => 'required|string',
            'jumlah_unit'    => 'required|integer|min:1',
            'ukuran_tenda'   => 'required|string',
            'warna_dekor'    => 'nullable|string',
            'jenis_kursi'    => 'required|string',
            'jumlah_kursi'   => 'required|integer|min:0',
            'estimasi_harga' => 'required|integer|min:0',
            'pakai_panggung' => 'required|boolean',
            'jenis_meja'     => 'nullable|string',
            'jumlah_meja'    => 'required|integer|min:0',
        ]);

        $pemesanan = HistoryPemesanan::create([
            'jenis_tenda'    => $request->jenis_tenda,
            'jumlah_unit'    => $request->jumlah_unit,
            'ukuran_tenda'   => $request->ukuran_tenda,
            'warna_dekor'    => $request->warna_dekor ?? '-',
            'jenis_kursi'    => $request->jenis_kursi,
            'jumlah_kursi'   => $request->jumlah_kursi,
            'estimasi_harga' => $request->estimasi_harga,
            'pakai_panggung' => $request->pakai_panggung,
            'jenis_meja'     => $request->jenis_meja,
            'jumlah_meja'    => $request->jumlah_meja,
            'tanggal_pesan'  => now(),
        ]);

        return response()->json([
            'status' => 'berhasil',
            'pesan'  => 'Pemesanan berhasil disimpan!',
            'id'     => $pemesanan->id,
        ]);
    }

    /**
     * Mengambil semua history pemesanan untuk panel admin.
     */
    public function daftarPemesanan()
    {
        $daftar = HistoryPemesanan::orderBy('tanggal_pesan', 'desc')
            ->get()
            ->map(function ($item) {
                return [
                    'id'             => $item->id,
                    'jenis_tenda'    => $item->jenis_tenda,
                    'jumlah_unit'    => $item->jumlah_unit,
                    'ukuran_tenda'   => $item->ukuran_tenda,
                    'warna_dekor'    => $item->warna_dekor,
                    'jenis_kursi'    => $item->jenis_kursi,
                    'jumlah_kursi'   => $item->jumlah_kursi,
                    'estimasi_harga' => $item->estimasi_harga_format,
                    'pakai_panggung' => $item->pakai_panggung,
                    'jenis_meja'     => $item->jenis_meja,
                    'jumlah_meja'    => $item->jumlah_meja,
                    'tanggal_pesan'  => $item->tanggal_pesan->format('d/m/Y H:i'),
                ];
            });

        return response()->json([
            'status' => 'berhasil',
            'data'   => $daftar,
        ]);
    }
}