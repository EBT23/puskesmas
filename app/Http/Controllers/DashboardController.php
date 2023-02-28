<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

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
	public function tambah_role(Request $request)
	{
		DB::table('role')->insert([
			'nama_role' => $request->nama_role,
			'date_created' => date('Y-m-d H:i:s'),
			'update_created' => null,
		]);
		return redirect()
			->route('role')
			->withSuccess('Role berhasil ditambahkan');
	}
	public function edit_role(Request $request, $id)
	{
		DB::table('role')
			->where('id', $id)
			->update(['nama_role' => $request->nama_role], ['update_created' => date('Y-m-d H:i:s')]);
		return redirect()
			->route('role')
			->withSuccess('Role berhasil di edit');
	}
	public function hapus_role($id)
	{
		DB::table('role')
			->where('id', $id)
			->delete();
		return redirect()
			->route('role')
			->withSuccess('Role berhasil dihapus');
	}
	public function poli()
	{
		$data['title'] = 'Kelola Poli';
		$poli = DB::table('poli')->get();
		return view('dashboard.poli', ['poli' => $poli], $data);
	}
	public function tambah_poli(Request $request)
	{
		DB::table('poli')->insert([
			'nama_poli' => $request->nama_poli,
			'poli_code' => $request->kode_poli,
			'date_created' => date('Y-m-d H:i:s'),
			'update_created' => null,
		]);
		return redirect()
			->route('poli')
			->withSuccess('poli berhasil ditambahkan');
	}
	public function edit_poli(Request $request, $id)
	{
		DB::table('poli')
			->where('id', $id)
			->update(['nama_poli' => $request->nama_poli], ['poli_code' => $request->kode_poli], ['update_created' => date('Y-m-d H:i:s')]);
		return redirect()
			->route('poli')
			->withSuccess('Poli berhasil di edit');
	}
	public function hapus_poli($id)
	{
		DB::table('poli')
			->where('id', $id)
			->delete();
		return redirect()
			->route('poli')
			->withSuccess('Poli berhasil dihapus');
	}
	public function dokter()
	{
		$data['title'] = 'Kelola Dokter';
		$poli = DB::table('poli')->get();
		$dokter = DB::table('dokter')
			->join('poli', 'dokter.id_poli', '=', 'poli.id')
			->select('dokter.*', 'poli.nama_poli')
			->get();

		return view('dashboard.dokter', ['poli' => $poli, 'dokter' => $dokter], $data);
	}
	public function tambah_dokter(Request $request)
	{
		DB::table('dokter')->insert([
			'nama_dokter' => $request->nama_dokter,
			'id_poli' => $request->poli,
			'alamat' => $request->alamat,
			'tempat_lahir' => $request->tempat_lahir,
			'tgl_lahir' => $request->tanggal_lahir,
			'no_telp' => $request->no_telepon,
			'jk' => $request->jenis_kelamin,
			'date_created' => date('Y-m-d H:i:s'),
			'update_created' => null,
		]);
		Alert::success('Success', 'Data Dokter Berhasil  Ditambah!!');
		return redirect()
			->route('dokter');
	}
}