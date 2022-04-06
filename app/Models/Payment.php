<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'company_id',
        'account_name',
        'account_type',
        'payment_date',
        'receiver_name',
        'description',
        'amount'
    ];
}
