<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserDetail extends Model
{
    use HasFactory;

    protected $table ='users_detail';
    protected $primarykey ='id';
    protected $fillable = [
        'jenis_kelamin',
        'tanggal_lahir',
        'nomor_telepon',
        'foto_profil',
        'nomor_karyawan'
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
