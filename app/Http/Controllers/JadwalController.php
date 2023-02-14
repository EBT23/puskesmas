<?php

namespace App\Http\Controllers;
use App\Models\JadwalDokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JadwalController extends Controller
{
    public function jadwal(){
        $data['title'] = 'Jadwal';
        return view('dashboard.jadwal',[
            'jadwalDokter' => JadwalDokter::getData(),
            'dataDokter' =>  DB::table('dokter')->get(),
            $data]);
    }

    function jadwalPost(Request $request){
        $data = [
        'dokter_id' => $request->dokter_id,
        'hari' => $request->hari,
        'dari_jam' => $request->dari_jam,
        'sampai_jam' => $request->sampai_jam,
        'date_created' => date('Y-m-d'),
        'update_created' => date('Y-m-d'),
        ];
        DB::table('jadwal_dokter')->insert($data);
        return redirect()->route('jadwal');
    }

    function editPost(Request $request,$id){
         $data = [
         'dokter_id' => $request->dokter_id,
         'hari' => $request->hari,
         'dari_jam' => $request->dari_jam,
         'sampai_jam' => $request->sampai_jam,
         'date_created' => date('Y-m-d'),
         'update_created' => date('Y-m-d'),
         ];
       
        JadwalDokter::updateById($id, $data);
        return redirect()->route('jadwal');
    }

function hapusJadwal($id){
DB::table('jadwal_dokter')->where('id', $id)->delete(); 
return redirect()->route('jadwal');
    }
}
