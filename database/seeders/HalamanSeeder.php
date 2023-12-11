<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class HalamanSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            DB::table('halaman')->insert([
                'judul' => $faker->sentence,
                'slug' => $faker->slug,
                'deskripsi' => $faker->text,
                'keyword' => $faker->words(3, true),
                'konten' => $faker->paragraphs(3, true),
                'status_publikasi' => $faker->randomElement(['published', 'draft', 'trash']),
                'urutan_menu' => $faker->numberBetween(1, 10),
                'user_id' => 1, // Pastikan tabel 'users' memiliki data dengan ID yang sesuai
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
