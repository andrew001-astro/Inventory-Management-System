<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'reference_no',
        'sender_id',
        'recipient_name',
        'recipient_address',
        'sub_total',
        'tax_rate',
        'tax_amount',
        'total',
        'amount_paid',
        'amount_due',
        'notes'
    ];
}
