<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FrontEnd extends Model
{
    protected $fillable = [
        'page',
        'content',
        'status'
    ];
}
