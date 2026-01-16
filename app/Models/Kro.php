<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kro extends Model
{
    protected $fillable = ['kode_kro', 'nama_kro', 'program_id'];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}
