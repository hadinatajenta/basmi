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
        Schema::table('transaksi_iklan', function (Blueprint $table) {
            $table->foreign('pengiklan_id')->references('id')->on('pengiklan')->onDelete('cascade');
            $table->foreign('jenis_iklan_id')->references('id')->on('jenis_iklan')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
