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
        Schema::create('jenis_dokumens', function (Blueprint $table) {
            $table->id();
            $table->string('nama_jenis');
            $table->string('icon')->default('bi-file-earmark');
            $table->string('warna')->default('#0D92F4');
            $table->timestamps();
        });

        Schema::create('dokumens', function (Blueprint $table) {
            $table->id();
            $table->string('nama_dokumen');
            $table->text('deskripsi')->nullable();
            $table->foreignId('jenis_dokumen_id')->constrained('jenis_dokumens')->onDelete('cascade');
            $table->string('file_path');
            $table->string('nama_file_asli');
            $table->string('ukuran_file')->nullable();
            $table->string('tipe_file')->nullable();
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumens');
        Schema::dropIfExists('jenis_dokumens');
    }
};
