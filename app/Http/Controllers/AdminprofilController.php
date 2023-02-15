<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminprofilController extends Controller
{
    public function profil(){
         $data['title'] = 'profil';
         $dataAdmin = DB::select('SELECT * from users WHERE role_id=1;');
        return view('dashboard.profil',['dataAdmin' => $dataAdmin],$data);
    }

    public function editProfil(Request $request,$id){
    $request->session()->regenerate();
    DB::table('users')->where('id', $id)->update([
    'full_name' => $request->nama,
    'email' => $request->email,
     ]);
    return redirect()->route('profilAdmin');
    }

}
