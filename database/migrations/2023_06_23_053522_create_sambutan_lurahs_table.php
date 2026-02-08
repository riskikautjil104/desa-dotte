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
        Schema::create('sambutan_lurah', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lurah');
            $table->text('sambutan_lurah');
            $table->string('gambar_lurah');
            $table->string('slug');
            $table->integer('views')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sambutan_lurah');
    }
};
