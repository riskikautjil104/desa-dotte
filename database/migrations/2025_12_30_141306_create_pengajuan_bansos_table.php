<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengajuan_bansos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_bansos_id')->constrained()->onDelete('cascade');
            $table->string('nik');
            $table->string('nama_lengkap');
            $table->string('no_kk');
            $table->text('alamat');
            $table->string('rt_rw');
            $table->string('no_hp');
            $table->integer('jumlah_tanggungan')->default(0);
            $table->decimal('penghasilan_perbulan', 15, 2)->nullable();
            $table->text('alasan_pengajuan');
            $table->enum('status_pengajuan', ['menunggu', 'diverifikasi', 'disetujui', 'ditolak'])->default('menunggu');
            $table->text('catatan_verifikasi')->nullable();
            $table->timestamp('tanggal_verifikasi')->nullable();
            $table->string('verifikator')->nullable();
            $table->string('foto_ktp')->nullable();
            $table->string('foto_kk')->nullable();
            $table->string('foto_rumah')->nullable();
            $table->timestamps();

            $table->index(['nik', 'status_pengajuan']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajuan_bansos');
    }
};
