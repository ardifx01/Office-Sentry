<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IzinKeluar extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'nama',
        'jam_keluar',
        'keperluan',
        'jam_masuk',
        'status',
    ];
}