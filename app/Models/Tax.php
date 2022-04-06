<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['company_id', 'name', 'rate', 'type', 'enabled'];

    /**
     * Sortable columns.
     *
     * @var array
     */
    public $sortable = ['name', 'rate', 'enabled'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }


}
