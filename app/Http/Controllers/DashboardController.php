<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }
    
    public function role()
    {
        $data['title'] = 'Role Management';
        $role = DB::table('role')->get();
        return view('dashboard.role', ['role' => $role], $data);
    }
}
