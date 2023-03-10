<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ObatController extends Controller
{
    public function obat()
    {
        $data['title'] = 'Kelola Obat';
        $dataObat = DB::select('SELECT * from obat');
        return view('dashboard.obat', ['dataObat' => $dataObat], $data);
    }

    public function obatPost(Request $request)
    {
        $data = [
            'nama_obat' => $request->nama_obat,
            'date_created' => date('Y-m-d'),
            'update_created' => date('Y-m-d'),
        ];
        DB::table('obat')->insert($data);
        Alert::success('Success', 'Obat berhasil ditambah!!');
        return redirect()->route('obat');
    }

    public function editObat(Request $request, $id)
    {
        DB::table('obat')->where('id', $id)->update([
            'nama_obat' => $request->nama_obat,
            'date_created' => date('Y-m-d'),
            'update_created' => date('Y-m-d'),
        ]);
        Alert::success('Success', 'Obat berhasil diedit!!');
        return redirect()->route('obat');
    }

    function hapusObat($id)
    {
        DB::table('obat')->where('id', $id)->delete();
        return redirect()->route('obat');
    }
}