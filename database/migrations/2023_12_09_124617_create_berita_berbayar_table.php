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
            $table->foreignId('berita_id')->nullable()->constrained('berita');
            $table->foreignId('pengiklan_id')->nullable()->constrained('pengiklan');
            $table->foreignId('users_id')->nullable()->constrained('users');
            $table->string('harga_iklan')->nullable(); // or foreignId if it's a foreign key
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
