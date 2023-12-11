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
        Schema::create('iklan_banner', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengiklan_id')->constrained('pengiklan');
            $table->enum('jenis_banner',['horizontal','box']);
            $table->string('gambar');
            $table->string('tanggal_masuk');
            $table->string('tanggal_keluar');
            $table->enum('status',['berjalan','selesai','memunggu']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('iklan_banner');
    }
};
