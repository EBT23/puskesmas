<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenyakitController extends Controller
{
    public function penyakit(){
        $data['title'] = 'Penyakit';
        $dataPenyakit = DB::select('SELECT * from penyakit');
        return view('dashboard.penyakit',['dataPenyakit' => $dataPenyakit],$data);
    }

    function penyakitPost(Request $request){
$data = [
    'nama_penyakit' => $request->nama_penyakit,
     'date_created' => date('Y-m-d'),
     'update_created' => date('Y-m-d'),
];
DB::table('penyakit')->insert($data);
return redirect()->route('penyakit');
}

public function editPenyakit(Request $request,$id){
DB::table('penyakit')->where('id', $id)->update([
        'nama_penyakit' => $request->nama_penyakit,
        'date_created' => date('Y-m-d'),
        'update_created' => date('Y-m-d'),
]);
return redirect()->route('penyakit');
}

function hapusPenyakit($id){
DB::table('penyakit')->where('id', $id)->delete();
return redirect()->route('penyakit');
}

}
