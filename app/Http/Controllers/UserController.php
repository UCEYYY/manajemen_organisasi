<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Absensi;
use App\Models\Dokumen;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function dashboard()
    {
        return view('user.dashboard');
    }

    public function agenda()
    {
        $agendas = Agenda::all();
        return view('user.agenda', compact('agendas'));
    }

    public function absensi()
    {
        
        $absensis = Absensi::where('user_id', Auth::id())->get();
        return view('user.absensi', compact('absensis'));
    }

    public function dokumen()
    {
        $dokumens = Dokumen::all();
        return view('user.dokumen', compact('dokumens'));
    }
}