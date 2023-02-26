<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Mail\SendEmail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
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
        $request->validate([]);

        User::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => 2,
            'is_active' => 1,
            'created_at' => time(),
            'updated_at' => null
        ]);

        $data['title'] = 'Login';
        Alert::success('Success', 'Akun berhasil dibuat!');
        return view('auth/login', $data);
    }
}