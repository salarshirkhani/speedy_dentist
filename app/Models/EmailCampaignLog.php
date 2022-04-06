<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailCampaignLog extends Model
{
    protected $fillable = [
        'user_id',
        'email_campaign_id',
        'smtp_configuration_id',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
