<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('p_p_i_d_s', function (Blueprint $table) {
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
            $table->timestamp('tanggal_publikasi')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('p_p_i_d_s');
    }
};
