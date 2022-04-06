<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'company_id',
        'user_id',
        'insurance_id',
        'invoice_date',
        'total',
        'vat_percentage',
        'total_vat',
        'discount_percentage',
        'total_discount',
        'grand_total',
        'paid',
        'due'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function insurance()
    {
        return $this->belongsTo(Insurance::class);
    }

    public function invoiceItems()
    {
        return $this->hasMany(InvoiceItem::class);
    }
}
