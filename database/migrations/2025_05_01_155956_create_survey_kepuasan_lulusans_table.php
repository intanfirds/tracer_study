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
        Schema::create('survey_kepuasan_lulusans', function (Blueprint $table) {
            $table->id('ID_Survey');
            $table->foreignId('ID_Alumni')->constrained('alumnis')->onDelete('cascade');
            $table->foreignId('ID_Instansi')->constrained('instansis')->onDelete('cascade');
            $table->date('tanggal');
            $table->string('kerja_sama_tim');
            $table->string('kemampuan_berbahasa_asing');
            $table->string('kemampuan_berkomunikasi');
            $table->string('etos_kerja');
            $table->text('saran_untuk_kurikulum_prodi');
            $table->text('kemampuan_tdk_terpenuhi');
            $table->string('status_pengisian');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('survey_kepuasan_lulusans');
    }
};
