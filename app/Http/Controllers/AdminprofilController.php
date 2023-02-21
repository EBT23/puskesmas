<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminprofilController extends Controller
{
				public function profil()
				{
								$data['title'] = 'profil';
								return view('dashboard.profil', $data);
				}

				public function editProfil(Request $request)
				{
								$data = $request->validate([
												'full_name' => ['required', 'max:191'],
												'email' => ['required', 'email'],
								]);
								auth()
												->user()
												->update($data);

								return redirect()
												->route('profilAdmin')
												->with('message', 'Your Profil has been Updated');
				}
}
