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
        Schema::create('berita', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->text('isi');
            $table->unsignedBigInteger('users_id');
            $table->date('tanggal_terbit');
            $table->string('gambar_utama')->nullable();
            $table->enum('status', ['draf', 'terbit']);
            $table->unsignedBigInteger('kategori_id')->nullable();
            $table->string('meta_title')->nullable();  
            $table->string('meta_description', 160)->nullable();
            $table->string('meta_keywords')->nullable();   
            $table->string('canonical_url')->nullable(); 
            $table->string('robots')->default('index, follow');
            $table->timestamps();
            
            $table->foreign('users_id')->references('id')->on('users');
            $table->foreign('kategori_id')->references('kategori_id')->on('category');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berita');
    }
};
