<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pendaftaran;
use App\Models\User;
use App\Mail\SendEmail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Kajian;
use Illuminate\Contracts\Session\Session;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{

    public function login()
    {
        $data['title'] = 'Login';
        return view('auth/login', $data);
    }
    public function login_action(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // $user = Auth::User();

            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withInput()->withErrors([
            'password' => 'Wrong username or password',
        ]);
    }
    public function password()
    {
        $data['title'] = 'Change Password';
        return view('auth/password', $data);
    }

    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
        Mail::send('auth.forgetPassword', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });
        Alert::success('Success', 'We have e-mailed your password reset link!');
        return back();
    }
    public function showResetPasswordForm($token)
    {
        return view('auth.recover-password', ['token' => $token]);
    }

    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('password_resets')
            ->where([
                'email' => $request->email,
                'token' => $request->token
            ])
            ->first();

        if (!$updatePassword) {
            Alert::error('errors', 'Invalid token!');
            return back()->withInput();
        }

        DB::table('users')->where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);
        $request->session()->regenerate();
        DB::table('password_resets')->where(['email' => $request->email])->delete();
        Alert::success('Success', 'Your password has been changed!');
        return redirect('/login');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function register()
    {
        $data['title'] = 'Register';
        return view('auth/register', $data);
    }

    public function register_action(Request $request)
    {
        $request->validate(
            [
                'full_name' => 'required',
                'email' => 'required|unique:users,email',
                'password' => 'required'
            ],
            [
                'nik' => 'required',
                'tgl_lahir' => 'required',
                'tempat_lahir' => 'required',
                'alamat' => 'required',
                'nama_kk' => 'required',
                'jk' => 'required',
                'sk' => 'required',
                'agama' => 'required',
                'no_telp' => 'required',
                'pekerjaan' => 'required',
                'pendidikan_terakhir' => 'required',
                'jaminan_asuransi' => 'required',
                'no_jaminan' => 'required'
            ],
            [
                'status' => $request->status,
                'riwayat_penyakit_terdahulu' => 'required',
                'riwayat_penyakit_keluarga' => 'required',
                'pengkajian_psikologis' => 'required',
                'riwayat_gangguan_jiwa' => 'required',
                'keluarga_gangguan_jiwa' => 'required',
                'tinggal_dengan' => 'required',
                'hambatan_bahasa' => 'required',
                'hambatan_budaya' => 'required',
                'hambatan_mobilitas' => 'required'
            ]
        );
        $id_user = rand(000000, 999999);
        User::create([
            'id_user' =>  $id_user,
            'full_name' => $request->full_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => 2,
            'is_active' => 1,
            'created_at' => now(),
        ]);
        Pendaftaran::create([
            'id_user' => $id_user,
            'nik' => $request->nik,
            'tgl_lahir' => $request->tgl_lahir,
            'tempat_lahir' => $request->tempat_lahir,
            'alamat' => $request->alamat,
            'nama_kk' => $request->nama_kk,
            'jk' => $request->jk,
            'sk' => $request->status,
            'agama' => $request->agama,
            'no_telp' => $request->no_telp,
            'pekerjaan' => $request->pekerjaan,
            'pendidikan_terakhir' => $request->pendidikan_terakhir,
            'jaminan_asuransi' => $request->jaminan_asuransi,
            'no_jaminan' => $request->no_jaminan,
            'no_rm' =>  'RM' . rand(100000, 99999),
            'created_at' => now()
        ]);
        Kajian::create([
            'id_user' => $id_user,
            'status' => $request->status,
            'riwayat_penyakit_terdahulu' => $request->riwayat_penyakit_terdahulu,
            'riwayat_penyakit_keluarga' => $request->riwayat_penyakit_keluarga,
            'pengkajian_psikologis' => $request->pengkajian_psikologis,
            'riwayat_gangguan_jiwa' => $request->riwayat_gangguan_jiwa,
            'keluarga_gangguan_jiwa' => $request->keluarga_gangguan_jiwa,
            'tinggal_dengan' => $request->tinggal_dengan,
            'hambatan_bahasa' => $request->hambatan_bahasa,
            'hambatan_budaya' => $request->hambatan_budaya,
            'hambatan_mobilitas' => $request->hambatan_mobilitas,
            'date_created' => now(),
            'update_created' => now(),
        ]);
        $data['title'] = 'Login';
        Alert::success('Success', 'Akun berhasil dibuat!');
        return view('auth/login', $data);
    }
}
//dicoba gus