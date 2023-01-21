<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemInvoice extends Model
{
    protected $fillable = [
        'item_id',
        'invoice_id',
        'quantity',
        'total'
    ];

    protected $table = "items_invoices";
}
