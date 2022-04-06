<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $fillable = [
        'user_id', 'doctor_id', 'weight', 'height', 'blood_pressure', 'chief_complaint',
        'medicine_info', 'diagnosis_info', 'note', 'prescription_date'
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
