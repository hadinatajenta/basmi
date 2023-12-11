<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SponsorTypes extends Model
{
    use HasFactory;

    protected $table ='jenis_iklan';
    protected $primaryKey = 'id';

    protected $fillable =[
        'jenis_iklan','price','deskripsi'
    ];
}
