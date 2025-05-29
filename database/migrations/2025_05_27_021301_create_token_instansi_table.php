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
        Schema::create('token_instansi', function (Blueprint $table) {
            $table->id('token_instansi_id');
            $table->string('token');
            $table->unsignedBigInteger('instansi_id');
            $table->foreign('instansi_id')->references('instansi_id')->on('instansis');
            $table->dateTime('expired_at')->nullable();
            $table->boolean('is_used')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('token_intansi');
    }
};
