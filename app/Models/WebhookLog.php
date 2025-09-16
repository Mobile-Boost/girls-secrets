<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class WebhookLog extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'provider',
        'action',
        'transaction_id',
        'subscriber_reference',
        'msisdn',
        'status',
        'status_description',
        'amount',
        'currency',
        'customer_country',
        'carrier',
        'merchant_subscriber_reference',
        'site_id',
        'product_id',
        'offer_id',
        'pricepoint_id',
        'payment_method',
        'transaction_date',
        'raw_data',
        'signature_valid',
        'error_message',
    ];

    protected $casts = [
        'raw_data' => 'array',
        'transaction_date' => 'datetime',
        'signature_valid' => 'boolean',
        'amount' => 'decimal:2',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id', 'transaction_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'subscriber_reference', 'subscription_id');
    }
}
