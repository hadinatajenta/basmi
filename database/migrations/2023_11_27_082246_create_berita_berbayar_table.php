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
        Schema::create('berita_berbayar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengiklan_id')->constrained('pengiklan','id');
            $table->string('judul');
            $table->string('isi');
            $table->string('deskripsi');
            $table->string('keyword');
            $table->string('slug');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berita_berbayar');
    }
};
