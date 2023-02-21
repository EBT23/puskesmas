<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PemeriksaanController extends Controller
{
     public function pemeriksaan()
     {
          $data['title'] = 'pemeriksaan';
          $dataAdmin = DB::select('SELECT * from users WHERE role_id=1;');
          $dataPasien = DB::select('SELECT * FROM users WHERE role_id=2;');
          $dataDokter = DB::table('dokter')->get();
          $dataKajian = DB::table('kajian_awal')->get();
          $dataPenyakit = DB::table('penyakit')->get();
          $dataObat = DB::table('obat')->get();
          $dataTujuan = DB::table('tujuan_pemeriksaan')->get();
          $dataAntrian = DB::table('antrian')->get();
          return view('dashboard.pemeriksaan', [
               'dataPasien' => $dataPasien,
               'dataDokter' => $dataDokter,
               'dataKajian' => $dataKajian,
               'dataPenyakit' => $dataPenyakit,
               'dataObat' => $dataObat,
               'dataTujuan' => $dataTujuan,
               'dataAntrian' => $dataAntrian,
          ], $data);
     }
     function addKajianAwal($id_user)
     {
          $query = DB::table('kajian_awal')->where('id_user', $id_user)->get();
          $data = "<option value=''> - Pilih Kajian - </option>";
          foreach ($query as $value) {
               $data .= "<option value='" . $value->id . "'>" . $value->id . "</option>";
          }
          return response()->json(['data' => $data]);
     }
     function addTujuanPemeriksaan($id_user)
     {
          $query = DB::table('tujuan_pemeriksaan')->where('user_id', $id_user)->get();
          $data = "<option value=''> - Pilih Tujuan Pemeriksaan - </option>";
          foreach ($query as $value) {
               $data .= "<option value='" . $value->id . "'>" . $value->id . "</option>";
          }
          return response()->json(['data' => $data]);
     }
     function addAntrian($id_user)
     {
          $query = DB::table('antrian')->where('id_user', $id_user)->get();
          $data = "<option value=''> - Pilih Antrian - </option>";
          foreach ($query as $value) {
               $data .= "<option value='" . $value->id . "'>" . $value->antrian . "</option>";
          }
          return response()->json(['data' => $data]);
     }

     function pemeriksaanPost(Request $request)
     {
          $data = [
               'id_user' => $request->id_user,
               'id_kajian' => $request->id_kajian,
               'id_tujuan' => $request->id_tujuan,
               'id_get_antrian' => $request->id_get_antrian,
               'id_dokter' => $request->id_dokter,
               'id_penyakit' => $request->id_penyakit,
               'id_obat' => $request->id_obat,
               'tgl_diperiksa' => $request->tgl_diperiksa,
               'date_created' => date('Y-m-d'),
               'update_created' => date('Y-m-d'),
          ];
          DB::table('pemeriksaan')->insert($data);
          return redirect()->route('pemeriksaan');
     }
}