<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reconciliation extends Model
{
    protected $table = 'reconciliations';

    protected $dates = ['deleted_at', 'started_at', 'ended_at'];

    protected $fillable = ['company_id', 'account_id', 'started_at', 'ended_at', 'closing_balance', 'reconciled'];

    public $sortable = ['created_at', 'account_id', 'started_at', 'ended_at', 'closing_balance', 'reconciled'];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function setClosingBalanceAttribute($value)
    {
        $this->attributes['closing_balance'] = (double) $value;
    }
}
