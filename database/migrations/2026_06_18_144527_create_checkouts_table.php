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
        Schema::create('checkouts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');
            $table->text('alamat_pengiriman');
            $table->decimal('total_harga', 15, 2);
            $table->json('produk_details');
            $table->dateTime('tanggal_pemesanan');
            $table->string('metode_pembayaran')->nullable();
            $table->string('metode_pengiriman')->nullable();
            $table->enum('status_pembayaran', [
                'pending',
                'menunggu_verifikasi',
                'dibayar',
                'gagal'
            ])->default('pending');
            $table->enum('status', [
                'pending',
                'diproses',
                'dikirim',
                'selesai',
                'dibatalkan'
            ])->default('pending');

            $table->string('bukti_transfer')->nullable();

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkouts');
    }
};