<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function index()
    {
        $agendas = Agenda::all();
        return view('admin.agenda.index', compact('agendas'));
    }

    public function create()
    {
        return view('admin.agenda.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kegiatan' => 'required',
            'deskripsi' => 'required',
            'waktu_mulai' => 'required|date',
            'waktu_selesai' => 'required|date|after:waktu_mulai',
            'tempat' => 'required'
        ]);
        Agenda::create($request->all());
        return redirect()->route('agenda.index')->with('success', 'Agenda berhasil dibuat');
    }

    public function show(Agenda $agenda)
    {
        return view('admin.agenda.show', compact('agenda'));
    }

    public function edit(Agenda $agenda)
    {
        return view('admin.agenda.edit', compact('agenda'));
    }

    public function update(Request $request, Agenda $agenda)
    {
        $request->validate([
            'nama_kegiatan' => 'required',
            'deskripsi' => 'required',
            'waktu_mulai' => 'required|date',
            'waktu_selesai' => 'required|date|after:waktu_mulai',
            'tempat' => 'required'
        ]);
        $agenda->update($request->all());
        return redirect()->route('agenda.index')->with('success', 'Agenda berhasil diperbarui');
    }

    public function destroy(Agenda $agenda)
    {
        $agenda->delete();
        return redirect()->route('agenda.index')->with('success', 'Agenda berhasil dihapus');
    }

    // Contoh method tambahan: search
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $agendas = Agenda::where('nama_kegiatan', 'like', "%$keyword%")
            ->orWhere('deskripsi', 'like', "%$keyword%")
            ->get();
        return view('admin.agenda.index', compact('agendas'));
    }
}