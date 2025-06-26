<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'deskripsi',
        'file_path',
        'tipe_dokumen',
        'user_id',
        'agenda_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function agenda()
    {
        return $this->belongsTo(Agenda::class);
    }
}