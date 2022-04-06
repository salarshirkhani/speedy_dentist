<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabReportTemplate extends Model
{
    protected $fillable = [
        'company_id',
        'name',
        'template'
    ];

    public function labReports()
    {
        return $this->hasMany(LabReport::class);
    }
}
