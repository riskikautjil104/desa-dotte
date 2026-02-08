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
        Schema::table('pelayanans', function (Blueprint $table) {
            $table->unsignedBigInteger('jenis_pelayanan_id');
            $table->foreign('jenis_pelayanan_id')->references('id')->on('jenis_pelayanan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pelayanans', function (Blueprint $table) {
            $table->dropColumn('jenis_pelayanan_id');
        });
    }
};
