<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('infografis', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->enum('jenis_infografis', [
                'penduduk',
                'ekonomi',
                'sosial', 
                'geografis',
                'umum',
                'program'
            ]);
            $table->json('data_json')->nullable();
            $table->string('gambar_path')->nullable();
            $table->boolean('status')->default(true);
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('infografis');
    }
};
