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
        Schema::table('berita', function (Blueprint $table) {
            $table->boolean('featured')->default(false)->after('status'); // Kolom boolean dengan nilai default false
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('berita', function (Blueprint $table) {
            $table->dropColumn('featured');
        });
    }

};
