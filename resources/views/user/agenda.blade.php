@extends('layouts.app')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Agenda Organisasi') }}
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
                                <th>Deskripsi</th>
                                <th>Waktu Mulai</th>
                                <th>Waktu Selesai</th>
                                <th>Tempat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($agendas as $agenda)
                                <tr>
                                    <td>{{ $agenda->nama_kegiatan }}</td>
                                    <td>{{ $agenda->deskripsi }}</td>
                                    <td>{{ \Carbon\Carbon::parse($agenda->waktu_mulai)->format('d M Y H:i') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($agenda->waktu_selesai)->format('d M Y H:i') }}</td>
                                    <td>{{ $agenda->tempat }}</td>
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