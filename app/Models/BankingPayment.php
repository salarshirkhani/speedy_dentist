<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankingPayment extends Model
{
    protected $table = 'banking_payments';
    protected $dates = ['paid_at'];

    protected $fillable = ['company_id', 'account_id', 'paid_at', 'amount', 'currency_code', 'currency_rate', 'vendor_id', 'description', 'category_id', 'payment_method', 'reference', 'parent_id'];

    public $sortable = ['paid_at', 'amount', 'category.name', 'account.name'];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_code', 'code');
    }

    public function transfers()
    {
        return $this->hasMany(Transfer::class);
    }
}
