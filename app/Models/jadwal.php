<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jadwal extends Model
{
    use HasFactory;
    public $table = 'jadwal';
    public $filltable=[
        'judul',
        'kategori',
        'deskripsi',
        'lokasi',
        'waktu'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
