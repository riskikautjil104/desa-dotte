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
        Schema::create('surat_onlines', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat')->unique()->nullable();
            $table->string('nama_pemohon');
            $table->string('nik')->nullable();
            $table->string('email')->nullable();
            $table->string('no_hp');
            $table->string('alamat')->nullable();
            $table->string('jenis_surat'); // keterangan_tinggal, skck, keterangan_usaha, keterangan_lain
            $table->text('keterangan')->nullable();
            $table->string('status')->default('menunggu'); // menunggu, diproses, selesai, ditolak
            $table->text('catatan_admin')->nullable();
            $table->string('file_hasil')->nullable();
            $table->timestamp('tanggal_selesai')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_onlines');
    }
};
