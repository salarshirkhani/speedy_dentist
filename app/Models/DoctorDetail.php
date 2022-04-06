<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorDetail extends Model
{
    protected $fillable = [
        'hospital_department_id',
        'user_id',
        'specialist',
        'designation',
        'biography'
    ];

    public function hospitalDepartment()
    {
        return $this->belongsTo(HospitalDepartment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCompanyIdAttribute()
    {
        return $this->user->company_id;
    }
}
