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
            $table->id('survey_id');
            $table->unsignedBigInteger('alumni_id');
            $table->foreign('alumni_id')->references('alumni_id')->on('alumnis');
            $table->unsignedBigInteger('instansi_id');
            $table->foreign('instansi_id')->references('instansi_id')->on('instansis');
            $table->date('tanggal');
            $table->string('kerjasama_tim');
            $table->string('keahlian_bidang_it');
            $table->string('kemampuan_berbahasa_asing');
            $table->string('kemampuan_berkomunikasi');
            $table->string('pengembangan_diri');
            $table->string('kepemimpinan');
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
