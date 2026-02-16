<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $fillable = [
        'kode',
        'nama',
        'nup',
        'jumlah',
        'satuan',
        'merk_tipe',
        'tgl_perolehan',
        'kondisi',
        'penanggung_jawab',
        'status',
    ];

    protected $dates = [
        'tgl_perolehan',
    ];
}
