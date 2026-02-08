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
        Schema::create('datapenduduks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_rt')->references('id')->on('rt');
            $table->foreignId('id_rw')->references('id')->on('rw');
            $table->foreignId('id_pendidikan')->references('id')->on('pendidikan');
            $table->foreignId('id_pekerjaan')->references('id')->on('pekerjaan');
            $table->string('alamat');
            $table->string('no_kk');
            $table->string('nama_kepala_keluarga');
            $table->string('nik');
            $table->string('nama');
            $table->string('jenis_kelamin');
            $table->string('hubungan');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->integer('usia');
            $table->string('status');
            $table->string('agama');
            $table->string('golongan_darah');
            $table->string('kewarganegaraan');
            $table->string('suku');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datapenduduks');
    }
};
