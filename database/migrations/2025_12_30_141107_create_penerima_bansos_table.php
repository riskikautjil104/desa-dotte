<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penerima_bansos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_bansos_id')->constrained()->onDelete('cascade');
            $table->string('nik');
            $table->string('nama_lengkap');
            $table->string('no_kk')->nullable();
            $table->text('alamat');
            $table->string('rt_rw')->nullable();
            $table->string('no_hp')->nullable();
            $table->integer('jumlah_tanggungan')->default(0);
            $table->enum('status_ekonomi', ['sangat_miskin', 'miskin', 'rentan_miskin'])->default('miskin');
            $table->enum('status_verifikasi', ['menunggu', 'diverifikasi', 'ditolak'])->default('menunggu');
            $table->text('keterangan')->nullable();
            $table->string('foto_rumah')->nullable();
            $table->timestamps();

            $table->index(['nik', 'jenis_bansos_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penerima_bansos');
    }
};

