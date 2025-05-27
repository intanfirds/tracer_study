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
        Schema::create('alumni_login_tokens', function (Blueprint $table) {
            $table->id('token_alumni_id');
            $table->string('email');
            $table->string('token')->unique();
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
        Schema::dropIfExists('alumni_login_tokens');
    }
};
