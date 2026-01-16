<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ro extends Model
{
    protected $fillable = ['kode_ro', 'nama_ro', 'kro_id'];

    public function kro()
    {
        return $this->belongsTo(Kro::class);
    }
}
