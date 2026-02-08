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
        Schema::create('u_m_k_m_s', function (Blueprint $table) {
            $table->id();
            $table->string('nama_usaha');
            $table->string('pemilik');
            $table->string('kategori'); // makanan, minuman, fashion, jasa, dll
            $table->text('deskripsi');
            $table->string('alamat')->nullable();
            $table->string('no_hp');
            $table->string('email')->nullable();
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('gambar_utama')->nullable();
            $table->json('galeri')->nullable(); // multiple images
            $table->string('status')->default('aktif'); // aktif, nonaktif, verifikasi
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->integer('views')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('u_m_k_m_s');
    }
};
