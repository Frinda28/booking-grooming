<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        try {
            Log::info('Proses login dimulai.', [
                'email' => $request->email
            ]);

            if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {
                Log::info('Login berhasil.', [
                    'email' => $request->email
                ]);

                return redirect()->route('bookings.index');
            }

            Log::warning('Login gagal.', [
                'email' => $request->email
            ]);

            return back()->withErrors([
                'email' => 'Email atau password salah!',
            ]);
        } catch (\Exception $e) {
            Log::error('Error saat proses login.', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return back()->withErrors([
                'email' => 'Terjadi kesalahan saat login.',
            ]);
        }
    }

    public function logout()
    {
        try {
            Log::info('Admin melakukan logout.', [
                'email' => Auth::guard('admin')->user()->email ?? 'Tidak diketahui'
            ]);

            Auth::guard('admin')->logout();

            return redirect()->route('login');
        } catch (\Exception $e) {
            Log::error('Error saat proses logout.', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return back()->withErrors([
                'error' => 'Terjadi kesalahan saat logout.',
            ]);
        }
    }
}
