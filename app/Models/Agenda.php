<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kegiatan',
        'deskripsi',
        'waktu_mulai',
        'waktu_selesai',
        'tempat'
    ];

    public function absensis()
    {
        return $this->hasMany(Absensi::class);
    }

    public function dokumens()
    {
        return $this->hasMany(Dokumen::class);
    }
}