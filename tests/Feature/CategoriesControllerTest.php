<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoriesControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function show_all_kategori():void
    {
        //Arrange membuat kategori baru sebagai sample
        $kategori1 = Category::create(['nama_kategori'=>'Berita','jumlah_postingan'=>0]);

        //Act :
        $response = $this->get(route('kategori'));

        //assert : memeriksa nama kategori yang telah dibuat diatas
        $response->assertStatus(200);
        $response->assertViewHas('kategori',function($kategori) use ($kategori1){
            return $kategori->contains($kategori1);
        });
    }
}
