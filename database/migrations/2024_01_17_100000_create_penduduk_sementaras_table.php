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
        Schema::create('penduduk_sementaras', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 20);
            $table->string('nama', 100);
            $table->enum('jenis_kelamin', ['LAKI-LAKI', 'PEREMPUAN']);
            $table->string('tempat_lahir', 50);
            $table->date('tanggal_lahir');
            $table->string('agama', 20);
            $table->enum('status_perkawinan', ['BELUM KAWIN', 'KAWIN', 'CERAI HIDUP', 'CERAI MATI']);
            $table->string('pendidikan_terakhir', 50);
            $table->string('jenis_pekerjaan', 50);
            
            // Data Domisili
            $table->text('alamat_asal');
            $table->text('alamat_sementara');
            $table->string('tujuan_tinggal', 50); // Bekerja, Studi, Keluarga, dll
            $table->string('estimasi_waktu', 50); // 1 bulan, 3 bulan, dll
            
            // Dokumen Pendukung
            $table->string('ktp_path', 255)->nullable();
            $table->string('kk_path', 255)->nullable();
            $table->string('surat_pengantar_path', 255)->nullable();
            $table->string('pas_foto_path', 255)->nullable();
            
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penduduk_sementaras');
    }
};

