<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;
    protected $table = 'dokter';
    public $timestamps = false;

    public static function updateById($id, $data)
    {
        self::where('id', $id)->update($data);
    }
}
