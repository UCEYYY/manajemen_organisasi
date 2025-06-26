<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Dokumen;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class DokumenController extends Controller
{
    public function index()
    {
        $dokumens = Dokumen::all();
        return view('admin.dokumen.index', compact('dokumens'));
    }

    public function create()
    {
        $agendas = Agenda::all();
        return view('admin.dokumen.create', compact('agendas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'nullable',
            'file' => 'required|file|mimes:pdf,docx|max:2048',
            'tipe_dokumen' => 'required|in:dokumen,laporan',
            'agenda_id' => 'nullable|exists:agendas,id'
        ]);
        $file = $request->file('file');
        $path = $file->store('uploads/' . $request->tipe_dokumen, 'public');
        Dokumen::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'file_path' => $path,
            'tipe_dokumen' => $request->tipe_dokumen,
            'user_id' => auth::user()->id,
            'agenda_id' => $request->agenda_id
        ]);
        return redirect()->route('dokumen.index')->with('success', 'Dokumen berhasil diunggah');
    }

    public function show(Dokumen $dokumen)
    {
        return view('admin.dokumen.show', compact('dokumen'));
    }

    public function edit(Dokumen $dokumen)
    {
        $agendas = Agenda::all();
        return view('admin.dokumen.edit', compact('dokumen', 'agendas'));
    }

    public function update(Request $request, Dokumen $dokumen)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'nullable',
            'file' => 'nullable|file|mimes:pdf,docx|max:2048',
            'tipe_dokumen' => 'required|in:dokumen,laporan',
            'agenda_id' => 'nullable|exists:agendas,id'
        ]);
        $data = $request->only(['judul', 'deskripsi', 'tipe_dokumen', 'agenda_id']);
        if ($request->hasFile('file')) {
            // Hapus file lama
            Storage::disk('public')->delete($dokumen->file_path);
            $file = $request->file('file');
            $path = $file->store('uploads/' . $request->tipe_dokumen, 'public');
            $data['file_path'] = $path;
        }
        $dokumen->update($data);
        return redirect()->route('dokumen.index')->with('success', 'Dokumen berhasil diperbarui');
    }

    public function destroy(Dokumen $dokumen)
    {
        Storage::disk('public')->delete($dokumen->file_path);
        $dokumen->delete();
        return redirect()->route('dokumen.index')->with('success', 'Dokumen berhasil dihapus');
    }
}