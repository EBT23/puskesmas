<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function kajian_awal(){

        $data['title'] = 'kajian awal';
        return view('pendaftaran.kajian_awal', $data);
    }

function kajianawalPost(Request $request){

$data = [
'status' => $request->status,
'riwayat_penyakit_terdahulu' => $request->riwayat_penyakit_terdahulu,
'riwayat_penyakit_keluarga' => $request->riwayat_penyakit_keluarga,
'pengkajian_psikologis' => $request->pengkajian_psikologis,
'riwayat_gangguan_jiwa' => $request->riwayat_gangguan_jiwa,
'keluarga_gangguan_jiwa' => $request->keluarga_gangguan_jiwa,
'tinggal_dengan' => $request-> tinggal_dengan,
'hambatan_bahasa' => $request-> hambatan_bahasa,
'hambatan_budaya' => $request-> hambatan_budaya,
'hambatan_mobilitas' => $request-> hambatan_mobilitas,
'date_created' => date('Y-m-d'),
'update_created' => date('Y-m-d'),
];
DB::table('kajian_awal')->insert($data);

return redirect()->route('kajian_awal');

}
}
