<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'midtrans_transaction_id',
        'payment_status',
        'payment_details'
    ];

    protected $casts = [
        'payment_details' => 'array'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
