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
        Schema::create('detail_profesi_alumnis', function (Blueprint $table) {
            $table->id('ID_Detail_Profesi');
            $table->foreignId('ID_Alumni')->constrained('alumnis')->onDelete('cascade');
            $table->foreignId('ID_Kategori')->constrained('kategori_profesis')->onDelete('cascade');
            $table->year('tahun_lulus');
            $table->date('tanggal_pertama_kerja');
            $table->integer('masa_tunggu');
            $table->date('tanggal_mulai_kerja_instansi_saat_ini');
            $table->string('profesi');
            $table->date('tanggal_pengisian');
            $table->string('status_pengisian');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_profesi_alumnis');
    }
};
