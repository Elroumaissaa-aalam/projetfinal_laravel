<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'generic_name',
        'brand_name',
        'category',
        'description',
        'image',
        'dosage_form',
        'strength',
        'unit_price',
        'stock_quantity',
        'minimum_stock_level',
        'supplier',
        'batch_number',
        'manufacturing_date',
        'expiry_date',
        'storage_conditions',
        'prescription_required',
        'status',
        'side_effects',
        'contraindications',
        'usage_instructions',
    ];

    protected $casts = [
        'unit_price' => 'decimal:2',
        'stock_quantity' => 'integer',
        'minimum_stock_level' => 'integer',
        'manufacturing_date' => 'date',
        'expiry_date' => 'date',
        'prescription_required' => 'boolean',
    ];

    /**
     * Get prescriptions that use this medicine.
     */
    public function prescriptions(): HasMany
    {
        return $this->hasMany(Prescription::class, 'medication', 'name');
    }

    /**
     * Check if medicine is low in stock.
     */
    public function isLowStock(): bool
    {
        return $this->stock_quantity <= $this->minimum_stock_level;
    }

    /**
     * Check if medicine is expired.
     */
    public function isExpired(): bool
    {
        return $this->expiry_date && $this->expiry_date->isPast();
    }

    /**
     * Check if medicine is near expiry (within 30 days).
     */
    public function isNearExpiry(): bool
    {
        return $this->expiry_date && $this->expiry_date->diffInDays(now()) <= 30;
    }

    /**
     * Get the stock status.
     */
    public function getStockStatusAttribute(): string
    {
        if ($this->stock_quantity <= 0) {
            return 'out_of_stock';
        } elseif ($this->isLowStock()) {
            return 'low_stock';
        } else {
            return 'in_stock';
        }
    }

    /**
     * Scope for active medicines.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope for low stock medicines.
     */
    public function scopeLowStock($query)
    {
        return $query->whereRaw('stock_quantity <= minimum_stock_level');
    }

    /**
     * Scope for expired medicines.
     */
    public function scopeExpired($query)
    {
        return $query->where('expiry_date', '<', now());
    }

    /**
     * Scope for medicines near expiry.
     */
    public function scopeNearExpiry($query)
    {
        return $query->whereBetween('expiry_date', [now(), now()->addDays(30)]);
    }

    /**
     * Get the medicine image URL.
     */
    public function getImageUrl()
    {
        if ($this->image && file_exists(public_path('storage/medicines/' . $this->image))) {
            return asset('storage/medicines/' . $this->image);
        }

        return null;
    }

    /**
     * Get image URL or default placeholder.
     */
    public function getImageUrlOrDefault()
    {
        return $this->getImageUrl() ?: null; // Return null to show old placeholder
    }
}
