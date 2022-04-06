<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SmtpConfiguration
 * @package App
 * @category model
 */
class SmtpConfiguration extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sender_name',
        'sender_email',
        'smtp_host',
        'smtp_port',
        'smtp_user',
        'smtp_password',
        'smtp_type',
        'status'
    ];
}
