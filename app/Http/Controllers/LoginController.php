<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    /**
     * Show the login form
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle login attempt
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        // Coba login dengan kredensial yang diberikan
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            // Regenerate session untuk keamanan
            $request->session()->regenerate();
            
            // Ambil user yang sudah login
            $user = Auth::user();
            
            // Periksa role dan redirect sesuai role
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Selamat datang, Admin!');
            } elseif ($user->role === 'user') {
                return redirect()->route('user.dashboard')->with('success', 'Selamat datang!');
            } else {
                // Jika role tidak dikenal, logout dan redirect ke login
                Auth::logout();
                return redirect()->route('login')->withErrors([
                    'email' => 'Role pengguna tidak valid.',
                ]);
            }
        }

        // Jika login gagal, kembali ke form login dengan error
        return back()->withErrors([
            'email' => 'Kredensial yang Anda masukkan tidak cocok dengan data kami.',
        ])->onlyInput('email');
    }

    /**
     * Handle logout
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login')->with('success', 'Anda telah berhasil logout.');
    }
}