<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('history_pemesanan', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_tenda');
            $table->integer('jumlah_unit');
            $table->string('ukuran_tenda');
            $table->string('warna_dekor');
            $table->string('jenis_kursi');
            $table->integer('jumlah_kursi')->default(0);
            $table->bigInteger('estimasi_harga');
            $table->boolean('pakai_panggung')->default(false);
            $table->string('jenis_meja')->nullable();
            $table->integer('jumlah_meja')->default(0);
            $table->timestamp('tanggal_pesan')->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('history_pemesanan');
    }
};