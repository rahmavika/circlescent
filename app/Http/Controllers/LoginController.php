<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Halaman login pelanggan
     */
    public function index()
    {
        return redirect('/')->with('login_modal', true);
    }

    /**
     * Proses login pelanggan
     */
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {

            $user = Auth::user();

            // Hanya pelanggan yang boleh login
            if ($user->role !== 'pelanggan') {

                Auth::logout();

                return redirect('/')
                    ->with('login_modal', true)
                    ->withErrors([
                        'email' => 'Login ini hanya untuk pelanggan.',
                    ])
                    ->withInput();
            }

            $request->session()->regenerate();

            // Simpan session
            session([
                'name'  => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
            ]);

            return redirect()->intended('/');
        }

        // Login gagal
        return redirect('/')
            ->with('login_modal', true)
            ->withErrors([
                'email' => 'Email atau password salah.',
            ])
            ->withInput();
    }

    /**
     * Logout pelanggan
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $request->session()->forget([
            'name',
            'email',
            'phone'
        ]);

        return redirect('/');
    }
}