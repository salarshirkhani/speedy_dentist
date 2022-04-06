<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id',
        'name',
        'code',
        'rate',
        'precision',
        'symbol',
        'symbol_first',
        'decimal_mark',
        'thousands_separator',
        'enabled'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
