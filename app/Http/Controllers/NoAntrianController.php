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
        return view('antrian.view', ['poli' => $poli], $data);
    }
    public function add(Request $request)
    {
        $antrian = DB::table('antrian')->where('id_user', Auth::user()->id)->where('id_poli', $request->id_poli)->first();
        $cek = DB::table('antrian')->where('id_poli', $request->id_poli)->latest('antrian')->first();
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