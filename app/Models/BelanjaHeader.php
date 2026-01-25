<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BelanjaHeader extends Model
{
    protected $fillable = [
        'program_id',
        'kro_id',
        'ro_id',
        'komponen_id',
        'nama_uraian',
        'kode_subkomponen',
        'nama_subkomponen',
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

    public function ros()
    {
        return $this->belongsTo(Ro::class, 'ro_id');
    }

    public function komponens()
    {
        return $this->belongsTo(Komponen::class, 'komponen_id');
    }

    public function items()
    {
        return $this->hasMany(BelanjaItem::class);
    }
}
