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

    //kelola penyakit
    Route::get('penyakit', [PenyakitController::class, 'penyakit'])->name('penyakit');
    Route::post('penyakit', [PenyakitController::class, 'penyakitPost'])->name('penyakit.post');

    //role
    Route::get('role', [DashboardController::class, 'role'])->name('role');


    ##Logout Dani
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});


Route::controller(UserFormController::class)->group(function () {
    Route::get('/users', 'index')->name('users.index');
    Route::post('users/form/create', 'createProcess')->name('users/form.create');
    Route::post('users/form/update', 'updateProcess')->name('users/form.update');
    Route::post('users/form/delete', 'deleteProcess')->name('usersform.delete');
});

# Users Form
// Route::get('users/', [UserFormController::class, 'index']);
// Route::post('users/create', [UserFormController::class, 'create'])->name('users.create');
// Route::post('articles', [UserFormController::class, 'store']);
// Route::get('articles/{id}', [UserFormController::class, 'show']);
