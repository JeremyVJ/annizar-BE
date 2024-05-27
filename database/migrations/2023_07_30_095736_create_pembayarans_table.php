<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaksi_id')->constrained();
            $table->date('tanggal_bayar');
            $table->string('rekening_asal');
            $table->string('no_rekening_asal');
            $table->string('pemilik_rekening');
            $table->string('rekening_tujuan');
            $table->integer('jumlah_bayar');
            $table->string('bukti_bayar');
            $table->string('status_bayar')->default('Menunggu Pembayaran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
