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
        Schema::create('alumnis', function (Blueprint $table) {
            $table->id('alumni_id');
            $table->unsignedBigInteger('level_id');
            $table->foreign('level_id')->references('level_id')->on('levels');
            $table->string('NIM')->unique();
            $table->string('password');
            $table->unsignedBigInteger('prodi_id');
            $table->foreign('prodi_id')->references('prodi_id')->on('program_studis');
            $table->string('nama');
            $table->string('no_hp')->nullable();
            $table->string('email')->unique()->nullable();
            $table->year('tahun_lulus');
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumnis');
    }
};
