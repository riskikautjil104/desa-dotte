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
        Schema::create('ppids', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->enum('kategori', [
                'informasiBerkala',
                'informasiSertaMerta',
                'informasiSetiapSaat',
                'informasiDikecualikan',
                'laporan',
                'dokumen'
            ]);
            $table->text('deskripsi')->nullable();
            $table->string('file_path')->nullable();
            $table->boolean('status')->default(true);
            $table->date('tanggal_publikasi')->default(now());
            $table->timestamps();

            // Indexes untuk performa
            $table->index('kategori');
            $table->index('status');
            $table->index('tanggal_publikasi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppids');
    }
};