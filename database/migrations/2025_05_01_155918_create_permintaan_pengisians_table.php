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
            $table->id('ID_Permintaan');
            $table->foreignId('ID_Admin')->constrained('admins')->onDelete('cascade');
            $table->foreignId('ID_Instansi')->constrained('instansis')->onDelete('cascade');
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
