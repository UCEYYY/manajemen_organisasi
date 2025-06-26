@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col">
            <h2 class="mb-4">Dashboard Anggota</h2>
            <div class="alert alert-success">
                Selamat datang, <strong>{{ Auth::user()->name }}</strong>!
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Card Absensi -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="fas fa-calendar-check fa-3x text-primary mb-3"></i>
                    <h5 class="card-title">Absensi</h5>
                    <p class="card-text">Lihat riwayat kehadiran kegiatan Anda.</p>
                    <a href="{{ route('user.absensi') }}" class="btn btn-outline-primary btn-sm">Lihat Absensi</a>
                </div>
            </div>
        </div>

        <!-- Card Agenda -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="fas fa-calendar-alt fa-3x text-success mb-3"></i>
                    <h5 class="card-title">Agenda</h5>
                    <p class="card-text">Lihat daftar kegiatan organisasi yang akan datang.</p>
                    <a href="{{ route('user.agenda') }}" class="btn btn-outline-success btn-sm">Lihat Agenda</a>
                </div>
            </div>
        </div>

        <!-- Card Dokumen -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="fas fa-file-alt fa-3x text-warning mb-3"></i>
                    <h5 class="card-title">Dokumen</h5>
                    <p class="card-text">Akses dokumen dan laporan kegiatan organisasi.</p>
                    <a href="{{ route('user.dokumen') }}" class="btn btn-outline-warning btn-sm">Lihat Dokumen</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
