<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenyakitController extends Controller
{
    public function penyakit(){
        $data['title'] = 'Penyakit';
        return view('dashboard.penyakit',$data);
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
}
