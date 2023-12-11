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
        Schema::create('users_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->enum('jenis_kelamin',['laki-laki','perempuan'])->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('nomor_telepon')->nullable();
            $table->string('foto_profil')->nullable();
            $table->string('nomor_karyawan')->nullable();
            $table->timestamps();

            //foreign key ke table users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_detail');
    }
};
