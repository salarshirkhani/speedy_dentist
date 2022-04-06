<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    protected $fillable = [
        'company_id',
        'name',
        'service_tax',
        'discount',
        'description',
        'insurance_no',
        'insurance_code',
        'disease_charge',
        'hospital_rate',
        'insurance_rate',
        'total',
        'status',
    ];
}
