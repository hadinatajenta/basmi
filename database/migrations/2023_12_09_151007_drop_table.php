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
        Schema::table('berita', function (Blueprint $table) {
            $table->dropForeign(['jenis_berita_id']); // Adjust this if the foreign key name is different
        });
        Schema::table('berita', function (Blueprint $table) {
            $table->dropColumn('jenis_berita_id');
        });
        Schema::dropIfExists('berita_berbayar');
        Schema::dropIfExists('banner_type');
        Schema::dropIfExists('jenis_berita');
        Schema::dropIfExists('pengiklan');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
