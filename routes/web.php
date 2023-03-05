<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PenyakitController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\AdminprofilController;
use App\Http\Controllers\NoAntrianController;
use App\Http\Controllers\UserprofilController;
use App\Http\Controllers\PemeriksaanController;
use App\Http\Controllers\UserFormController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	return view('auth.login');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'login_action'])->name('login.action');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'register_action'])->name('register.action');
Route::get('/password', [AuthController::class, 'password'])->name('password');

Route::get('forget-password', [AuthController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [AuthController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [AuthController::class, 'submitResetPasswordForm'])->name('reset.password.post');

Route::middleware(['auth'])->group(function () {
	Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

	##Agus
	Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran');
	Route::post('pendaftaran', [PendaftaranController::class, 'pendaftaran_action'])->name('pendaftaran.action');

	#Hamdi
	Route::get('/kajianawal', [PendaftaranController::class, 'kajian_awal'])->name('kajian_awal');
	Route::post('/kajianawal', [PendaftaranController::class, 'kajianawalPost'])->name('kajian_awal.post');

	//kelola jadwal dokter
	Route::get('jadwal', [JadwalController::class, 'jadwal'])->name('jadwal');
	Route::post('jadwal', [JadwalController::class, 'jadwalPost'])->name('jadwal.post');
	Route::post('jadwal/{id}', [JadwalController::class, 'editPost'])->name('editJadwal');
	Route::delete('hapusjadwal/{id}', [JadwalController::class, 'hapusJadwal'])->name('hapusJadwal');

	//kelola penyakit
	Route::get('penyakit', [PenyakitController::class, 'penyakit'])->name('penyakit');
	Route::post('penyakit', [PenyakitController::class, 'penyakitPost'])->name('penyakit.post');
	Route::post('penyakit/{id}', [PenyakitController::class, 'editPenyakit'])->name('editPenyakit');
	Route::delete('hapuspenyakit/{id}', [PenyakitController::class, 'hapusPenyakit'])->name('hapusPenyakit');

	// kelola obat
	Route::get('obat', [ObatController::class, 'obat'])->name('obat');
	Route::post('obat', [ObatController::class, 'obatPost'])->name('obat.post');
	Route::post('obat/{id}', [ObatController::class, 'editObat'])->name('editObat');
	Route::delete('hapusobat/{id}', [ObatController::class, 'hapusObat'])->name('hapusObat');

	//admin profil
	Route::get('profil', [AdminprofilController::class, 'profil'])->name('profilAdmin');
	Route::put('profil', [AdminprofilController::class, 'editProfil'])->name('editProfilAdmin');

	//input pemeriksaan oleh admin
	Route::get('pemeriksaan', [PemeriksaanController::class, 'pemeriksaan'])->name('pemeriksaan');
	Route::post('pemeriksaan', [PemeriksaanController::class, 'pemeriksaanPost'])->name('pemeriksaan.Post');
	Route::post('addKajianAwal/{id}', [PemeriksaanController::class, 'addKajianAwal'])->name('pemeriksaan.addKajianAwal');
	Route::post('addTujuanPemeriksaan/{id}', [PemeriksaanController::class, 'addTujuanPemeriksaan'])->name('pemeriksaan.addTujuanPemeriksaan');
	Route::post('addAntrian/{id}', [PemeriksaanController::class, 'addAntrian'])->name('pemeriksaan.addAntrian');

	//role
	Route::get('role', [DashboardController::class, 'role'])->name('role');
	Route::post('role', [DashboardController::class, 'tambah_role'])->name('role.post');
	Route::post('role/{id}', [DashboardController::class, 'edit_role'])->name('role.edit');
	Route::delete('hapus_role/{id}', [DashboardController::class, 'hapus_role'])->name('role.hapus');

	//poli
	Route::get('poli', [DashboardController::class, 'poli'])->name('poli');
	Route::post('poli', [DashboardController::class, 'tambah_poli'])->name('poli.post');
	Route::post('poli/{id}', [DashboardController::class, 'edit_poli'])->name('poli.edit');
	Route::delete('hapus_poli/{id}', [DashboardController::class, 'hapus_poli'])->name('poli.hapus');

	//dokter
	Route::get('dokter', [DashboardController::class, 'dokter'])->name('dokter');
	Route::post('dokter', [DashboardController::class, 'tambah_dokter'])->name('dokter.post');
	Route::post('dokter/{id}', [DashboardController::class, 'edit_dokter'])->name('dokter.edit');
	Route::delete('hapus_dokter/{id}', [DashboardController::class, 'hapus_dokter'])->name('dokter.hapus');

	#Dani
	Route::get('noAntrian', [NoAntrianController::class, 'view'])->name('noAntrian');

	Route::post('noAntrian/add', [NoAntrianController::class, 'add'])->name('noAntrian.add');
	Route::get('cetakAntrian/{id}', [NoAntrianController::class, 'cetakAntrian'])->name('noAntrian.cetakAntrian');

	##Logout Dani
	Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});

## Agus Kartu pasien
Route::get('/kartuPasien', [PendaftaranController::class, 'kartuPasien'])->name('kartu.pasien');
Route::get('/cetakKartu', [PendaftaranController::class, 'cetakPDF'])->name('cetak.kartu');
