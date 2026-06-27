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
        Schema::create('varians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produk_id')
                ->constrained()
                ->onDelete('cascade');

            // pilihan pelanggan
            $table->enum('level', [
                'Exclusive',
                'Premium',
                'VIP',
                'VVIP'
            ]);

            $table->enum('ml', [
                '30ml',
                '50ml',
                '100ml'
            ]);

            // inventaris
            $table->integer('stok')->default(0);
            $table->decimal('harga', 12, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('varians');
    }
};