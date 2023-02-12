<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;

class PendaftaranController extends Controller
{
    public function index()
    {

        $data['title'] = 'Pendaftaran';
        return view('pendaftaran.index', $data);
    }
    public function pendaftaran_action(Request $request)
    {

        $request->validate([]);

        $input = Pendaftaran::create([
            'id_user' => $request->session()->get('id'),
            'nama' => $request->nama,
            'nik' => $request->nik,
            'tgl_lahir' => $request->tgl_lahir,
            'tempat_lahir' => $request->tempat_lahir,
            'alamat' => $request->alamat,
            'nama_kk' => $request->nama_kk,
            'jk' => $request->jk,
            'status' => $request->status,
            'agama' => $request->agama,
            'no_telp' => $request->no_telp,
            'pekerjaan' => $request->pekerjaan,
            'pendidikan_terakhir' => $request->pendidikan_terakhir,
            'jaminan_asuransi' => $request->jaminan_asuransi,
            'no_jaminan' => $request->no_jaminan,
            'no_rm' => rand(100000, 999999),
            'created_at' => time(),
            'updated_at' => null
        ]);

        dd($input);
    }
}
