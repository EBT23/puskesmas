<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserFormController extends Controller
{
    public function index()
    {
        //$pendaftaran = DB::table('pendaftaran')->get();
        //dd($pendaftaran);

        return view('users.index', [
            'pendaftaran' => DB::table('pendaftaran')->get(),
        ]);
    }
    public function create()
    {
        return view('users.create');
    }
}