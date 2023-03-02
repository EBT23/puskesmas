<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class PenyakitController extends Controller
{
    public function penyakit()
    {
        $data['title'] = 'Kelola Penyakit';
        $dataPenyakit = DB::select('SELECT * from penyakit');
        return view('dashboard.penyakit', ['dataPenyakit' => $dataPenyakit], $data);
    }

    function penyakitPost(Request $request)
    {
        $data = [
            'nama_penyakit' => $request->nama_penyakit,
            'date_created' => date('Y-m-d'),
            'update_created' => date('Y-m-d'),
        ];
        DB::table('penyakit')->insert($data);
        Alert::success('Success', 'Nama penyakit berhasil ditambah!!');
        return redirect()->route('penyakit');
    }

    public function editPenyakit(Request $request, $id)
    {
        DB::table('penyakit')->where('id', $id)->update([
            'nama_penyakit' => $request->nama_penyakit,
            'date_created' => date('Y-m-d'),
            'update_created' => date('Y-m-d'),
        ]);
        Alert::success('Success', 'Nama penyakit berhasil diubah!!');
        return redirect()->route('penyakit');
    }

    function hapusPenyakit($id)
    {
        DB::table('penyakit')->where('id', $id)->delete();
        return redirect()->route('penyakit');
    }
}