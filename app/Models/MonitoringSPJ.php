<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MonitoringSPJ extends Model
{
    use SoftDeletes;

    protected $table = 'monitoring_spjs';

    protected $fillable = [
        'submitted_at',
        'activity_date',
        'division',
        'mak_number',
        'activity_name',
        'rab',
        'realization',
        'pelaksana_approved_at',
        'tu_approved_at',
        'ppk_approved_at',
        'finance_approved_at',
        'status',
        'notes',
    ];

    protected $casts = [
        'submitted_at' => 'date',
        'activity_date' => 'date',
        'pelaksana_approved_at' => 'date',
        'tu_approved_at' => 'date',
        'ppk_approved_at' => 'date',
        'finance_approved_at' => 'date',
        'rab' => 'integer',
        'realization' => 'integer',
    ];
}
