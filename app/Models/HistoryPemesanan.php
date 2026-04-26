<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/*
|--------------------------------------------------------------------------
| Model: HistoryPemesanan — VERSI UPDATE
|--------------------------------------------------------------------------
| Letakkan di: app/Models/HistoryPemesanan.php (timpa yang lama)
|--------------------------------------------------------------------------
*/

class HistoryPemesanan extends Model
{
    protected $table = 'history_pemesanan';

    protected $fillable = [
        'jenis_tenda',
        'jumlah_unit',
        'ukuran_tenda',
        'warna_dekor',
        'jenis_kursi',
        'jumlah_kursi',
        'estimasi_harga',
        'pakai_panggung',
        'jenis_meja',
        'jumlah_meja',
        'tanggal_pesan',
    ];

    protected $casts = [
        'tanggal_pesan'  => 'datetime',
        'estimasi_harga' => 'integer',
        'pakai_panggung' => 'boolean',
    ];

    /**
     * Format estimasi harga ke Rupiah.
     */
    public function getEstimasiHargaFormatAttribute(): string
    {
        return 'Rp ' . number_format($this->estimasi_harga, 0, ',', '.');
    }
}