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
        Schema::create('penduduk_kematian', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 20)->unique();
            $table->string('nama', 100);
            $table->date('tanggal_kematian');
            $table->text('sebab_kematian')->nullable();
            $table->string('tempat_kematian', 200)->nullable();
            $table->string('yang_melaporkan', 100)->nullable();
            $table->string('hub_dengan_almarhum', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penduduk_kematian');
    }
};

