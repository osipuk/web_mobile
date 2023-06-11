<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'status',
        'customer_name',
        'transaction_id',
        'description',
        'date',
        'amount',
        'invoice_pdf',
        'service_name'
    ];
}
