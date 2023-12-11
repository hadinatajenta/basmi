<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pengiklan extends Model
{
    use HasFactory;

    protected $table ='pengiklan';
    protected $primaryKey ='id';

    protected $fillable =[
        'name','email','notelp','alamat','nama_perusahaan','website'
    ];

    public function transaksi():HasMany
    {
        return $this->hasMany(Transaksi::class,'pengiklan_id');
    }
}
