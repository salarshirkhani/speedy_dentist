<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ApplicationSetting
 * @package App
 * @category model
 */
class ApplicationSetting extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'item_name',
        'item_short_name',
        'item_version',
        'company_name',
        'company_email',
        'company_address',
        'developed_by',
        'developed_by_href',
        'developed_by_title',
        'developed_by_prefix',
        'support_email',
        'language',
        'time_zone',
        'favicon',
    ];

    public $incrementing = false;
}
