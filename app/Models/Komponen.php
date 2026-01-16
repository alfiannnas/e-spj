<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komponen extends Model
{
    protected $fillable = ['kode_komponen', 'nama_komponen', 'ro_id'];

    public function ro()
    {
        return $this->belongsTo(Ro::class);
    }
}
