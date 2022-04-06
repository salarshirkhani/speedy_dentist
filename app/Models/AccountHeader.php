<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountHeader extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'company_id',
        'name',
        'type',
        'description',
        'status'
    ];
}
