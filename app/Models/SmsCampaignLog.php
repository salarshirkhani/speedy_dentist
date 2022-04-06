<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmsCampaignLog extends Model
{
    protected $fillable = [
        'user_id',
        'sms_campaign_id',
        'sms_api_id',
        'delivery_id',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
