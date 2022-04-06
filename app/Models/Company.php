<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Company
 * @package App
 * @category model
 */
class Company extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'domain',
        'enabled'
    ];

    public function users()
    {
        return $this->morphedByMany(User::class, 'user', 'user_companies', 'company_id', 'user_id');
    }

    public function currencies()
    {
        return $this->hasMany(Currency::class);
    }

    public function taxes()
    {
        return $this->hasMany(Tax::class);
    }

    public function settings()
    {
        return $this->hasMany(Setting::class);
    }

    public function setSettings()
    {
        $settings = $this->settings;

        foreach ($settings as $setting) {
            list($group, $key) = explode('.', $setting->getAttribute('key'));

            // Load only general settings
            if ($group != 'general') {
                continue;
            }

            $value = $setting->getAttribute('value');

            if ($key == 'company_logo') {
                $value = empty($value) ? asset('assets/images/company.png') : asset($value);
            }

            $this->setAttribute($key, $value);
        }
    }

}
