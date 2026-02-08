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
        Schema::create('aspirasis', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email')->nullable();
            $table->string('no_hp');
            $table->string('alamat');
            $table->enum('kategori', ['infrastruktur', 'pendidikan', 'kesehatan', 'ekonomi', 'sosial', 'lingkungan', 'lainnya'])->default('lainnya');
            $table->string('judul');
            $table->text('deskripsi');
            $table->enum('status', ['baru', 'diproses', 'selesai', 'ditolak'])->default('baru');
            $table->integer('views')->default(0);
            $table->integer('votes')->default(0);
            $table->text('tanggapan')->nullable();
            $table->timestamp('tanggal_tanggapan')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aspirasis');
    }
};
