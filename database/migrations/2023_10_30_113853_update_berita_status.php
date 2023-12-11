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
        // Ubah kolom status menjadi tipe text sementara
        Schema::table('berita', function (Blueprint $table) {
            $table->text('status')->change();
        });

        // Ubah kembali kolom status menjadi tipe enum dengan opsi yang diinginkan
        Schema::table('berita', function (Blueprint $table) {
            $table->enum('status', ['draf', 'terbit', 'menunggu', 'ditolak'])->change();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Ubah kolom status kembali ke tipe enum awal
        Schema::table('berita', function (Blueprint $table) {
            $table->text('status')->change();
        });

        Schema::table('berita', function (Blueprint $table) {
            $table->enum('status', ['draf', 'terbit'])->change();
        });
    }

};
