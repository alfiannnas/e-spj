<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MeetingRoomBooking extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'booking_date',
        'booking_time',
        'booking_purpose',
        'booking_status',
    ];
}
