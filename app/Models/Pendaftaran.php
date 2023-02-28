<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;
    protected $table = "pendaftaran";
    protected $fillable = [
        'id_pendaftaran',
        'id_user',
        'nik',
        'tgl_lahir',
        'tempat_lahir',
        'alamat',
        'nama_kk',
        'jk',
        'sk',
        'agama',
        'no_telp',
        'pekerjaan',
        'pendidikan_terakhir',
        'jaminan_asuransi',
        'no_jaminan',
        'no_rm',
        'created_at',
        'updated_at',
    ];
}
