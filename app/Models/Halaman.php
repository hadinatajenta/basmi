<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Halaman extends Model
{
    use HasFactory;

    protected $table ='halaman';
    protected $primaryKey ='id';
    protected $fillable = [
        'judul',
        'slug',
        'deskripsi',
        'keyword',
        'konten',
        'status_publikasi',
        'urutan_menu',
        'user_id'  
    ];


    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
