<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorSchedule extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'weekday',
        'start_time',
        'end_time',
        'avg_appointment_duration',
        'serial_type',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
