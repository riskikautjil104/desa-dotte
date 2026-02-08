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
        Schema::create('penduduk_pindah', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 20)->unique();
            $table->string('nama', 100);
            $table->date('tanggal_pindah');
            $table->string('alamat_asal', 200);
            $table->string('tujuan_pindah', 200);
            $table->string('alasan_pindah', 255)->nullable();
            $table->enum('jenis_pindah', ['Dalam Kota', 'Luar Kota', 'Luar Provinsi', 'Luar Negeri'])->default('Dalam Kota');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penduduk_pindah');
    }
};

