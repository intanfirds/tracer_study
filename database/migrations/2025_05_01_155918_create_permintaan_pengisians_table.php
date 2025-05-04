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
        Schema::create('permintaan_pengisians', function (Blueprint $table) {
            $table->id('permintaan_id');
            $table->unsignedBigInteger('admin_id');
            $table->foreign('admin_id')->references('admin_id')->on('admins');
            $table->unsignedBigInteger('instansi_id');
            $table->foreign('instansi_id')->references('instansi_id')->on('instansis');
            $table->date('tanggal_dikirim');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permintaan_pengisians');
    }
};
