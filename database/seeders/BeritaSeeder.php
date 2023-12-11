<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; 


class BeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            $judul = "Judul Berita Contoh " . $i;
            $slug = Str::slug($judul);  // Menghasilkan slug dari judul
            
            DB::table('berita')->insert([
                'users_id' => 1,
                'judul' => $judul,
                'slug' => $slug,
                'isi' => "Isi berita contoh ke-$i disini. Anda bisa menggunakan lorem ipsum atau teks lainnya.",
                'tanggal_terbit' => now(),
                'gambar_utama' => null, // asumsi tidak ada gambar utama
                'status' => 'terbit',
                'kategori_id' => 26,
                'meta_title' => "Meta Title Berita Contoh $i",
                'meta_description' => "Deskripsi singkat dari berita contoh ke-$i untuk SEO.",
                'meta_keywords' => "keyword$i, keyword$i, keyword$i",
                'canonical_url' => "https://contoh.com/$slug",
                'robots' => 'index, follow',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
