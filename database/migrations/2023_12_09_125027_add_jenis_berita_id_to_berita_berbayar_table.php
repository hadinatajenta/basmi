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
        Schema::table('berita_berbayar', function (Blueprint $table) {
            $table->foreignId('jenis_berita_id')->nullable()->after('berita_id')->constrained('jenis_berita');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('berita_berbayar', function (Blueprint $table) {
            //
        });
    }
};
