<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kajian extends Model
{
    use HasFactory;
    protected $table = "kajian_awal";
    protected $fillable = [
        'id',
        'id_user',
        'status',
        'riwayat_penyakit_terdahulu',
        'riwayat_penyakit_keluarga',
        'pengkajian_psikologis',
        'riwayat_gangguan_jiwa',
        'keluarga_gangguan_jiwa',
        'tinggal_dengan',
        'hambatan_bahasa',
        'hambatan_budaya',
        'hambatan_mobilitas',
        'date_created',
        'update_created',
    ];
}
