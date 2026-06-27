<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    /**
     * Halaman login admin
     */
    public function index()
    {
        return view('admin.auth.login');
    }

    /**
     * Proses login admin
     */
    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {

            $user = Auth::user();

            // hanya admin
            if ($user->role !== 'admin') {
                Auth::logout();

                return back()->withErrors([
                    'email' => 'Login ini hanya untuk admin.',
                ])->onlyInput('email');
            }

            $request->session()->regenerate();

            $request->session()->put('name', $user->name);
            $request->session()->put('email', $user->email);

            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    /**
     * Logout admin
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}