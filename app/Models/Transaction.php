<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
	    'company_id', 
	    'user_id', 
	    'tax_id', 
	    'type', 
	    'status',
	    'is_quatation', 
	    'payment_status', 
	    'invoice_number',
	    'ref_number', 
	    'before_tax', 
	    'tax_amount',
	    'discount_type', 
	    'discount_amount', 
	    'shipping_details',
	    'shipping_charge', 
	    'notes', 
	    'final_total',
	    'transaction_date'
    ];
}
