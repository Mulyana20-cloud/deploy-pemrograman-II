<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'sales_id',
        'order_number',
        'name',
        'email',
        'phone',
        'address',
        'payment_method',
        'payment_status',
        'order_status',
        'subtotal',
        'credit_simulation',
        'installment_months',
        'installment_amount',
        'sales_commission',
        'commission_status',
    ];

    protected function casts(): array
    {
        return [
            'credit_simulation' => 'boolean',
            'installment_months' => 'integer',
            'installment_amount' => 'decimal:2',
            'sales_commission' => 'decimal:2',
            'subtotal' => 'decimal:2',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function sales(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sales_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
