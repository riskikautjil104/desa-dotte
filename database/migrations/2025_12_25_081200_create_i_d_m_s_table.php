<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('i_d_m_s', function (Blueprint $table) {
            $table->id();
            $table->year('tahun');
            $table->integer('skor'); // 0-100
            $table->text('deskripsi')->nullable();
            $table->boolean('status')->default(true); // true = data aktif
            $table->timestamps();
            
            $table->unique(['tahun', 'status']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('i_d_m_s');
    }
};
