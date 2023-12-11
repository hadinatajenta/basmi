<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'category';
    protected $primaryKey = 'kategori_id';
    protected $fillable = [
        'nama_kategori',
        'jumlah_postingan'
    ];

    public function berita()
    {
        return $this->hasMany(Berita::class,'kategori_id');
    }
}
