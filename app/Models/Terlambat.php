<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Terlambat extends Model
{
    use HasFactory;

    protected $table = 'izin-terlambat';

    protected $fillable = [
        'nik',
        'nama',
        'tanggal',
        'jam',
        'approval1',
        'approval2',
        'tgl_app1',
        'tgl_app2',
        'alasan',
        'tgl_app3',
        'tgl_app4',
        'jenis',
        'last',
        'tgl_awal',
        'tgl_akhir',
        'hari',
        'kategori',
        'pengganti',
        'alasan1',
        'alasan2',
        'file',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'tgl_app1' => 'date',
        'tgl_app2' => 'date',
        'tgl_app3' => 'date',
        'tgl_app4' => 'date',
        'tgl_awal' => 'date',
        'tgl_akhir' => 'date',
    ];

// Define any relationships or custom methods here as needed
}