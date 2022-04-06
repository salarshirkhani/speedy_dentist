<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id',
        'key',
        'value'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
