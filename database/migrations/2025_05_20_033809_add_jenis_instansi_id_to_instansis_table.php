<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('instansis', function (Blueprint $table) {
        $table->unsignedBigInteger('jenis_instansi_id')->nullable()->after('alumni_id');

        // Jika ingin buat foreign key juga:
        // $table->foreign('jenis_instansi_id')->references('jenis_instansi_id')->on('jenis_instansis')->onDelete('set null');
    });
}

public function down()
{
    Schema::table('instansis', function (Blueprint $table) {
        $table->dropColumn('jenis_instansi_id');
    });
}

};
