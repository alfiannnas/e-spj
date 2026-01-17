<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BelanjaHeader extends Model
{
    protected $fillable = [
        'program_id',
        'kro_id',
        'ro_id',
        'nama_uraian',
        'satuan',
        'harga',
        'jumlah',
    ];

    public function programs()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }

    public function kros()
    {
        return $this->belongsTo(Kro::class, 'kro_id');
    }
}
