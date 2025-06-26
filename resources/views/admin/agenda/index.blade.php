
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Agenda') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('agenda.create') }}" class="btn btn-primary mb-3">Tambah Agenda</a>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Kegiatan</th>
                                <th>Waktu Mulai</th>
                                <th>Waktu Selesai</th>
                                <th>Tempat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($agendas as $agenda)
                                <tr>
                                    <td>{{ $agenda->nama_kegiatan }}</td>
                                    <td>{{ \Carbon\Carbon::parse($agenda->waktu_mulai)->format('d M Y H:i') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($agenda->waktu_selesai)->format('d M Y H:i') }}</td>
                                    <td>{{ $agenda->tempat }}</td>
                                    <td>
                                        <a href="{{ route('agenda.show', $agenda->id) }}" class="btn btn-info btn-sm">Lihat</a>
                                        <a href="{{ route('agenda.edit', $agenda->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('agenda.destroy', $agenda->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Yakin ingin menghapus agenda ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada agenda.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>