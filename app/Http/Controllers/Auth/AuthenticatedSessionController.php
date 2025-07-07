<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Tampilkan halaman login.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Proses login dan redirect berdasarkan role.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Lakukan autentikasi (cek username dan password)
        $request->authenticate();

        // Regenerate session agar aman dari session fixation
        $request->session()->regenerate();

        // Ambil user yang sudah login
        $user = $request->user();

        if (! $user) {
            // Jika user tidak ditemukan, kembali ke login dengan error
            return redirect()->route('login')->withErrors([
                'username' => 'Login gagal, coba lagi.',
            ]);
        }

        // Redirect langsung berdasarkan role
        switch ($user->role) {
            case 'admin':
                return redirect('/admin');
            case 'manager':
                return redirect('/manager');
            case 'pic':
                return redirect('/pic');
            case 'pelaksana':
                return redirect('/pelaksana');
            default:
                return redirect('/dashboard');
        }
    }

    /**
     * Logout user.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
