<?php

namespace App\Http\Controllers;

use App\Models\JadwalDokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class JadwalController extends Controller
{
    public function jadwal()
    {
        $data['title'] = 'Jadwal';
        return view('dashboard.jadwal', [
            'jadwalDokter' => JadwalDokter::getData(),
            'dataDokter' =>  DB::table('dokter')->get(),
            $data
        ]);
    }

    function jadwalPost(Request $request)
    {
        $request->validate(
            [
                'dokter_id' => 'required',
                'hari' => 'required',
                'dari_jam' => 'required',
                'sampai_jam' => 'required'
            ],
            [
                'dokter_id.required' => 'Nama Dokter harus diisi',
                'hari.required' => 'Hari harus diisi',
                'dari_jam.required' => 'Waktu harus diisi',
                'sampai_jam.required' => 'Waktu harus diisi'
            ]
        );
        $data = [
            'dokter_id' => $request->dokter_id,
            'hari' => $request->hari,
            'dari_jam' => $request->dari_jam,
            'sampai_jam' => $request->sampai_jam,
            'date_created' => date('Y-m-d'),
            'update_created' => date('Y-m-d'),
        ];
        DB::table('jadwal_dokter')->insert($data);
        Alert::success('Success', 'Jadwal Dokter berhasil dibuat!!');
        return redirect()->route('jadwal');
    }

    function editPost(Request $request, $id)
    {
        $data = [
            'dokter_id' => $request->dokter_id,
            'hari' => $request->hari,
            'dari_jam' => $request->dari_jam,
            'sampai_jam' => $request->sampai_jam,
            'date_created' => date('Y-m-d'),
            'update_created' => date('Y-m-d'),
        ];

        JadwalDokter::updateById($id, $data);
        Alert::success('Success', 'Jadwal Dokter berhasil diedit!!');
        return redirect()->route('jadwal');
    }

    function hapusJadwal($id)
    {
        DB::table('jadwal_dokter')->where('id', $id)->delete();
        Alert::success('Success', 'Jadwal Dokter berhasil dihapus!!');
        return redirect()->route('jadwal');
    }
}
