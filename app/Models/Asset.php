<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asset extends Model
{
    use SoftDeletes;
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
