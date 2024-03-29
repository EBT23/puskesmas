<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class NoAntrianController extends Controller
{
    public function view()
    {
        $data['title'] = 'Poli';
        $poli = DB::select('SELECT * from poli');
        $antrian = DB::select('SELECT u.*, a.id as id_antrian, a.antrian, a.id_poli, a.id_user, a.created_at, p.nama_poli from antrian a left join users u on a.id_user=u.id left join poli p on p.id=a.id_poli where a.id_user = ' . Auth::user()->id . ' and a.created_at like ("%' . date('Y-m-d') . '%")');
        // dd($antrian);
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
        $cek = DB::table('antrian')->where('id_poli', $request->id_poli)->where('created_at', 'LIKE', '%' . date('Y-m-d') . '%')->latest('antrian')->first();
        if ($antrian == true) {
            Alert::error('Gagal', 'Anda sudah Mendaftar di poli ini');
            return back();
        } else {
            if ($cek == null) {
                $data = [
                    'antrian' => 1,
                    'id_user' => Auth::user()->id,
                    'id_poli' => $request->id_poli,
                    'status' => "Y",
                    'created_at' => now(),
                ];
            } else {
                $data = [
                    'antrian' => $cek->antrian + 1,
                    'id_user' => Auth::user()->id,
                    'id_poli' => $request->id_poli,
                    'status' => "Y",
                    'created_at' => now(),
                ];
            }
            DB::table('antrian')->insert($data);
            Alert::success('Success', 'Selamat anda berhasil Mendaftar di poli ini');
            return back();
        }
    }
    
    public function viewAdmin()
    {
        $data['title'] = 'Nomor Antrian';
        $poli = DB::select('SELECT * from poli');
        $antrian = DB::select('SELECT u.*, a.id as id_antrian, a.antrian, a.id_poli, a.id_user, a.created_at, p.nama_poli from antrian a left join users u on a.id_user=u.id left join poli p on p.id=a.id_poli where a.id_user = ' . Auth::user()->id . ' and a.created_at like ("%' . date('Y-m-d') . '%")');
        // dd($antrian);
        return view('dashboard.getAntrian', ['poli' => $poli, 'antrian' => $antrian], $data);
    }

    public function listAntrian($id)
    {
        $data['title'] = 'List Antrian';
        $poli_code = $id;
        // $this->load_data($id);
        $poli = DB::select('SELECT * from poli');
        $antrian = DB::select('SELECT u.*, a.id as id_antrian, a.antrian, a.id_poli, a.id_user, a.created_at, a.status, p.nama_poli, p.poli_code from antrian a left join users u on a.id_user=u.id left join poli p on p.id=a.id_poli where p.poli_code = "' . $id . '" and a.created_at like ("%' . date('Y-m-d') . '%")');
        // dd($antrian);
        return view('dashboard.listAntrian', ['poli' => $poli, 'antrian' => $antrian, 'poli_code' => $poli_code], $data);
    }
    public function load_data(Request $request)
    {

        $antrian = DB::select('SELECT u.*, a.id as id_antrian, a.antrian, a.id_poli, a.id_user, a.created_at, a.status, p.nama_poli, p.poli_code from antrian a left join users u on a.id_user=u.id left join poli p on p.id=a.id_poli where  p.poli_code = "' . $request->poli_code . '" and a.created_at like ("%' . date('Y-m-d') . '%") and a.status = "Y" order by a.antrian asc');
        echo json_encode($antrian);
    }
    public function load_dataNoAktif(Request $request)
    {
        $data = DB::select('SELECT u.*, a.id as id_antrian, a.antrian, a.id_poli, a.id_user, a.created_at, a.status, p.nama_poli, p.poli_code from antrian a left join users u on a.id_user=u.id left join poli p on p.id=a.id_poli where  p.poli_code = "' . $request->poli_code . '" and a.created_at like ("%' . date('Y-m-d') . '%") and a.status = "N" order by a.antrian asc');
        // dd($data);
        echo json_encode($data);
        // return DataTables::of($antrianNo)->toJson();
    }
    public function doneAntrian($id)
    {
        $data = [
            'status' => 'N'
        ];
        // dd($id);
        DB::table('antrian')->where('id', $id)->update($data);
        $antrianNo = DB::select('SELECT u.*, a.id as id_antrian, a.antrian, a.id_poli, a.id_user, a.created_at, a.status, p.nama_poli, p.poli_code from antrian a left join users u on a.id_user=u.id left join poli p on p.id=a.id_poli where  p.poli_code = "' . $id . '" and a.created_at like ("%' . date('Y-m-d') . '%") and a.status = "N" order by a.antrian asc');
        echo json_encode($antrianNo);
        // return DataTables::of($antrianNo)->toJson();
    }
    public function backAntrian($id)
    {
        $data = [
            'status' => 'Y'
        ];
        // dd($id);
        DB::table('antrian')->where('id', $id)->update($data);
        $antrianNo = DB::select('SELECT u.*, a.id as id_antrian, a.antrian, a.id_poli, a.id_user, a.created_at, a.status, p.nama_poli, p.poli_code from antrian a left join users u on a.id_user=u.id left join poli p on p.id=a.id_poli where  p.poli_code = "' . $id . '" and a.created_at like ("%' . date('Y-m-d') . '%") and a.status = "N" order by a.antrian asc');
        echo json_encode($antrianNo);
        // return DataTables::of($antrianNo)->toJson();
    }
    
}