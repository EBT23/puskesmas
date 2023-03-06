<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class NoAntrianController extends Controller
{
    public function view()
    {
        $data['title'] = 'Poli';
        $poli = DB::select('SELECT * from poli');
        $antrian = DB::select('SELECT u.*, a.id as id_antrian, a.antrian, a.id_poli, a.id_user, a.created_at, p.nama_poli from antrian a left join users u on a.id_user=u.id left join poli p on p.id=a.id_poli where a.id_user = ' . Auth::user()->id . ' and a.created_at like ("%' . date('Y-m-d') . '%")');
        return view('antrian.view', ['poli' => $poli, 'antrian' => $antrian], $data);
    }
    public function cetakAntrian($id)
    {
        $data['title'] = 'Cetak Antrian';
        $antrian = DB::select('SELECT u.*, a.id as id_antrian, a.antrian, a.id_poli, a.id_user, a.created_at, p.nama_poli from antrian a left join users u on a.id_user=u.id left join poli p on p.id=a.id_poli where a.id = ' . $id . '');

        return view('antrian.cetakAntrian', ['antrian' => $antrian], $data);
    }
    public function add(Request $request)
    {
        $antrian = DB::table('antrian')->where('id_user', Auth::user()->id)->where('id_poli', $request->id_poli)->where('created_at', 'LIKE', '%' . date('Y-m-d') . '%')->first();
        $cek = DB::table('antrian')->where('id_poli', $request->id_poli)->where('created_at', date('Y-m-d'))->latest('antrian')->first();
        if ($antrian == true) {
            Alert::error('Gagal', 'Anda sudah Mendaftar di poli ini');
            return back();
        } else {
            if ($cek == null) {
                $data = [
                    'antrian' => 1,
                    'id_user' => Auth::user()->id,
                    'id_poli' => $request->id_poli,
                    'created_at' => now(),
                ];
            } else {
                $data = [
                    'antrian' => $cek->antrian + 1,
                    'id_user' => Auth::user()->id,
                    'id_poli' => $request->id_poli,
                    'created_at' => now(),
                ];
            }
            DB::table('antrian')->updateOrInsert($data);
            Alert::success('Success', 'Selamat anda berhasil Mendaftar di poli ini');
            return back();
        }
    }
}