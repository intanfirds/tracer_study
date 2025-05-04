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
        Schema::create('instansis', function (Blueprint $table) {
            $table->id('instansi_id');
            $table->unsignedBigInteger('level_id');
            $table->foreign('level_id')->references('level_id')->on('levels');
            $table->unsignedBigInteger('alumni_id');
            $table->foreign('alumni_id')->references('alumni_id')->on('alumnis');
            $table->string('nama_instansi');
            $table->string('nama_atasan');
            $table->string('jenis');
            $table->string('jabatan');
            $table->string('skala');
            $table->string('email_atasan');
            $table->string('no_hp_atasan');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instansis');
    }
};
