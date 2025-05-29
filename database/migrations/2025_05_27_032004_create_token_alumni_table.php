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
        Schema::create('token_alumni', function (Blueprint $table) {
            $table->id('token_alumni_id');
            $table->string('email')->nullable();
            $table->string('token')->unique();
            $table->unsignedBigInteger('alumni_id');
            $table->foreign('alumni_id')->references('alumni_id')->on('alumnis');
            $table->dateTime('expires_at');
            $table->dateTime('used_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('token_alumni');
    }   
};
