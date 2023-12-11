<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $table ='berita';
    
    protected $fillable = [
        'judul',
        'slug',
        'isi',
        'gambar_utama',
        'meta_description',
        'meta_keyword',
        'canonical_url',
        'jenis_berita_id',
        'status',
        'featured',
        'kategori_id',
        'robots',
        'users_id'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class,'kategori_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
   
}
