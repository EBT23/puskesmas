<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JadwalController extends Controller
{
    public function jadwal(){
        $data['title'] = 'Jadwal';
        return view('dashboard.jadwal',$data);
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
        // dd($data);
        DB::table('jadwal_dokter')->insert($data);

        return redirect()->route('jadwal');
    }
}
