<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SmsCampaign extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'company_id',
        'campaign_name',
        'sms_template_id',
        'message',
        'schedule_time',
        'contact_type',
        'status',
    ];
}
