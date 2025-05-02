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
            $table->id('ID_Alumni');
            $table->foreignId('ID_Level')->constrained('levels')->onDelete('cascade');
            $table->string('NIM')->unique();
            $table->string('password');
            $table->string('program_studi');
            $table->string('nama');
            $table->string('no_hp');
            $table->string('email')->unique();
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
