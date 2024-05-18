<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerification;

class AuthController extends Controller
{
    
    /**
     * Menampilkan formulir login.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Menangani proses autentikasi pengguna saat login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->isAdmin() || Auth::user()->isOwner()) {
                return redirect()->intended('/admin/dashboard'); 
            } else {
                return redirect()->intended('/'); 
            }
        } else {
            // Check if the email exists in the database
            $user = User::where('email', $request->email)->first();
            if (!$user) {
                return redirect()->route('login')->with('error', 'Email yang Anda masukkan tidak terdaftar.');
            } else {
                return redirect()->route('login')->with('error', 'Kata sandi yang Anda masukkan salah.');
            }
        }
    }

    /**
     * Menampilkan formulir registrasi.
     *
     * @return \Illuminate\View\View
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * Menangani proses registrasi pengguna.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function registerUser(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
            $user = User::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'email_verified_at' => null,
            ]);

            $user->sendEmailVerificationNotification();

            Auth::login($user);

            return redirect()->route('verification.notice')->with('success', 'Registrasi berhasil! Silakan verifikasi email Anda.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat registrasi. Silakan coba lagi.');
        }
    }

    

    /**
     * Menangani proses logout pengguna.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
    
    /**
     * Menampilkan dashboard pengguna.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard(Request $request)
    {
        return view('tampilan-admin.dashboard');
    }

}
