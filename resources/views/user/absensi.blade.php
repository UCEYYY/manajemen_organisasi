
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Absensi') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Kegiatan</th>
                                <th>Waktu Mulai</th>
                                <th>Waktu Selesai</th>
                                <th>Tempat</th>
                                <th>Status Kehadiran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($absensis as $absensi)
                                <tr>
                                    <td>{{ $absensi->agenda->nama_kegiatan ?? '-' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($absensi->agenda->waktu_mulai ?? null)->format('d M Y H:i') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($absensi->agenda->waktu_selesai ?? null)->format('d M Y H:i') }}</td>
                                    <td>{{ $absensi->agenda->tempat ?? '-' }}</td>
                                    <td>
                                        @if($absensi->kehadiran)
                                            <span class="badge bg-success">Hadir</span>
                                        @else
                                            <span class="badge bg-danger">Tidak Hadir</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada data absensi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app