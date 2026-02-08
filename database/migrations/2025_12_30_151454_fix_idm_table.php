<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;



return new class extends Migration
{
    public function up()
    {
        // Cek apakah tabel i_d_m_s ada
        if (Schema::hasTable('i_d_m_s')) {
            // Rename tabel dari i_d_m_s ke idms
            Schema::rename('i_d_m_s', 'idms');
        }

        // Modifikasi struktur tabel idms
        Schema::table('idms', function (Blueprint $table) {
            // Drop unique constraint jika ada
            // $table->dropUnique(['tahun', 'status']); // Uncomment jika error
            
            // Modifikasi kolom skor ke decimal
            $table->decimal('skor', 5, 2)->change();
            
            // Tambahkan index untuk performa
            if (!Schema::hasColumn('idms', 'tahun')) {
                $table->index('tahun');
            }
            if (!Schema::hasColumn('idms', 'status')) {
                $table->index('status');
            }
        });
    }

    public function down()
    {
        // Rollback jika diperlukan
        Schema::table('idms', function (Blueprint $table) {
            $table->dropIndex(['tahun']);
            $table->dropIndex(['status']);
            $table->integer('skor')->change();
        });
        
        Schema::rename('idms', 'i_d_m_s');
    }
};
