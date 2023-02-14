<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalDokter extends Model
{
    use HasFactory;

    protected $table = 'jadwal_dokter';
    public $timestamps = false;

       public static function updateById($id, $data){
        self::where('id',$id)->update($data);
    }

    public static function getData(){
       return self::leftjoin('dokter', 'jadwal_dokter.dokter_id', '=', 'dokter.id')->get(['jadwal_dokter.*', 'dokter.nama_dokter']);
    }
}
