<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jenis_bansos', function (Blueprint $table) {
            $table->id();
            $table->string('nama_bantuan');
            $table->string('kode_bantuan')->unique();
            $table->text('deskripsi')->nullable();
            $table->enum('kategori', ['reguler', 'darurat', 'khusus', 'musiman'])->default('reguler');
            $table->enum('sumber_dana', ['apbd', 'apbn', 'desa', 'lainnya'])->default('desa');
            $table->decimal('nominal_bantuan', 15, 2)->nullable();
            $table->enum('jenis_bantuan', ['uang', 'barang', 'campuran'])->default('uang');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jenis_bansos');
    }
};