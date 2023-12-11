<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Transaksi extends Model
{
    use HasFactory;

    protected $table ='transaksi_iklan';
    protected $primaryKey ='id';

    protected $fillable = [
        'pengiklan_id', 'jenis_iklan_id','tanggal_mulai','tanggal_selesai','total_harga'
    ];


    public function pengiklan():BelongsTo
    {
        return $this->belongsTo(Pengiklan::class,'pengiklan_id');
    }
}
