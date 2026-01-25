<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BelanjaItem extends Model
{
    protected $fillable = [
        'belanja_header_id',
        'akun_id',
        'nama_item',
        'jumlah',
        'satuan',
        'harga',
    ];

    public function belanjaHeader()
    {
        return $this->belongsTo(BelanjaHeader::class);
    }

    public function akun()
    {
        return $this->belongsTo(Akun::class);
    }
}
