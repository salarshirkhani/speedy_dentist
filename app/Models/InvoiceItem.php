<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    protected $fillable = [
        'company_id',
        'invoice_id',
        'account_name',
        'description',
        'account_type',
        'quantity',
        'price'
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
