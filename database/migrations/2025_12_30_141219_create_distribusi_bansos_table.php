<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('distribusi_bansos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penerima_bansos_id')->constrained()->onDelete('cascade');
            $table->foreignId('jenis_bansos_id')->constrained()->onDelete('cascade');
            $table->string('periode'); // Format: YYYY-MM atau YYYY-QX (quarter) atau YYYY
            $table->date('tanggal_distribusi');
            $table->decimal('nominal_diterima', 15, 2)->nullable();
            $table->text('barang_diterima')->nullable(); // JSON jika barang
            $table->enum('status_penerimaan', ['terjadwal', 'diterima', 'ditunda', 'dibatalkan'])->default('terjadwal');
            $table->string('bukti_penerimaan')->nullable(); // foto/scan tanda tangan
            $table->text('catatan')->nullable();
            $table->timestamp('tanggal_diterima')->nullable();
            $table->string('petugas')->nullable();
            $table->timestamps();

            $table->index(['periode', 'jenis_bansos_id']);
            $table->index('tanggal_distribusi');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('distribusi_bansos');
    }
};