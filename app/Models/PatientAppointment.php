<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientAppointment extends Model
{
    protected $fillable = [
        'user_id',
        'doctor_id',
        'sequence',
        'start_time',
        'end_time',
        'appointment_date',
        'problem'
    ];

    // user = patient
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function doctor()
    {
        return $this->belongsTo(User::class);
    }
}
