<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'patient_id',
        'subtotal',
        'tax_amount',
        'shipping_amount',
        'total_amount',
        'status',
        'payment_status',
        'payment_method',
        'stripe_payment_intent_id',
        'shipping_address',
        'billing_address',
        'notes',
        'ordered_at',
        'shipped_at',
        'delivered_at',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'shipping_amount' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'ordered_at' => 'datetime',
        'shipped_at' => 'datetime',
        'delivered_at' => 'datetime',
    ];

    /**
     * Get the patient that owns the order.
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    /**
     * Get the order items.
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get the payment for this order.
     */
    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class, 'stripe_payment_intent_id', 'stripe_payment_intent_id');
    }

    /**
     * Generate a unique order number.
     */
    public static function generateOrderNumber(): string
    {
        do {
            $orderNumber = 'ORD-' . strtoupper(uniqid());
        } while (self::where('order_number', $orderNumber)->exists());

        return $orderNumber;
    }

    /**
     * Get the status badge color.
     */
    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'pending' => 'bg-yellow-100 text-yellow-800',
            'confirmed' => 'bg-blue-100 text-blue-800',
            'processing' => 'bg-purple-100 text-purple-800',
            'shipped' => 'bg-indigo-100 text-indigo-800',
            'delivered' => 'bg-green-100 text-green-800',
            'cancelled' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    /**
     * Get the payment status badge color.
     */
    public function getPaymentStatusColorAttribute(): string
    {
        return match($this->payment_status) {
            'pending' => 'bg-yellow-100 text-yellow-800',
            'paid' => 'bg-green-100 text-green-800',
            'failed' => 'bg-red-100 text-red-800',
            'refunded' => 'bg-gray-100 text-gray-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    /**
     * Get formatted total amount.
     */
    public function getFormattedTotalAttribute(): string
    {
        return '$' . number_format($this->total_amount, 2);
    }

    /**
     * Get order items summary.
     */
    public function getItemsSummaryAttribute(): string
    {
        $items = $this->items->map(function ($item) {
            return $item->medicine_name . ' x' . $item->quantity;
        });

        return $items->join(', ');
    }

    /**
     * Scope for orders by status.
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope for orders by payment status.
     */
    public function scopeByPaymentStatus($query, $paymentStatus)
    {
        return $query->where('payment_status', $paymentStatus);
    }

    /**
     * Scope for recent orders.
     */
    public function scopeRecent($query, $days = 30)
    {
        return $query->where('ordered_at', '>=', now()->subDays($days));
    }
}
