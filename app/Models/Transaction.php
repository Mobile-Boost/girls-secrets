<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'user_id',
        'provider',
        'action',
        'transaction_id',
        'subscriber_reference',
        'status',
        'status_description',
        'amount',
        'currency',
        'customer_country',
        'transaction_date',
        'metadata',
    ];

    protected $casts = [
        'transaction_date' => 'datetime',
        'amount' => 'decimal:2',
        'metadata' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function webhookLogs()
    {
        return $this->hasMany(WebhookLog::class, 'transaction_id', 'transaction_id');
    }
}
