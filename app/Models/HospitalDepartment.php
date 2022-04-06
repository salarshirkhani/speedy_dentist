<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HospitalDepartment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'company_id',
        'name',
        'description',
        'status'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function doctorDetails()
    {
        return $this->hasMany(DoctorDetail::class);
    }
}
