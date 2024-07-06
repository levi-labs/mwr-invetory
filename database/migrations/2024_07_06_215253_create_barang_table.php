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
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('kategori_id')->unsigned();
            $table->string('kode');
            $table->string('nama');
            $table->integer('stok');
            $table->integer('harga');
            $table->string('ukuran')->nullable();
            $table->string('warna')->nullable();
            $table->string('satuan')->nullable();
            $table->string('gambar');
            $table->string('deskripsi');
            $table->timestamps();

            $table->foreign('kategori_id')->references('id')->on('kategori')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
