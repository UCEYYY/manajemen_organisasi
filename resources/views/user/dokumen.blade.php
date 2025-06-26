
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dokumen Organisasi') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th>Tipe Dokumen</th>
                                <th>Agenda</th>
                                <th>File</th>
                                <th>Diunggah Pada</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($dokumens as $dokumen)
                                <tr>
                                    <td>{{ $dokumen->judul }}</td>
                                    <td>{{ $dokumen->deskripsi }}</td>
                                    <td>{{ ucfirst($dokumen->tipe_dokumen) }}</td>
                                    <td>{{ $dokumen->agenda->nama_kegiatan ?? '-' }}</td>
                                    <td>
                                        <a href="{{ asset('storage/' . $dokumen->file_path) }}" target="_blank" class="btn btn-sm btn-primary">
                                            Lihat/Unduh
                                        </a>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($dokumen->created_at)->format('d M Y H:i') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada dokumen.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>