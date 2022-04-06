<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LabReport extends Model
{
    protected $fillable = [
        'company_id',
        'date',
        'patient_id',
        'doctor_id',
        'lab_report_template_id',
        'report',
        'photo'
    ];

    public function labReportTemplate()
    {
        return $this->belongsTo(LabReportTemplate::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }
}
