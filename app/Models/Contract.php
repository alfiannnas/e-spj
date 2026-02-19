<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contract extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'satuan_kerja',
        'tanggal_sp',
        'nama_pejabat_penandatangan',
        'nama_penyedia',
        'nama_paket_pengadaan',
        'sumber_dana',
        'waktu_pelaksanaan',
        'nilai_kontrak',
    ];

    protected $casts = [
        'tanggal_sp' => 'date',
        'waktu_pelaksanaan' => 'date',
    ];
}
