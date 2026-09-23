<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'business_unit_id',
        'category_id',
        'name',
        'slug',
        'description',
        'short_description',
        'base_price',
        'pricing_type',
        'estimated_days',
        'status',
        'featured'
    ];

    protected $casts = [
        'base_price' => 'decimal:2',
        'estimated_days' => 'integer',
        'featured' => 'boolean',
    ];

    public function businessUnit(): BelongsTo
    {
        return $this->belongsTo(BusinessUnit::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function requests(): HasMany
    {
        return $this->hasMany(ServiceRequest::class);
    }

    public function getFormattedPriceAttribute(): string
    {
        if ($this->pricing_type === 'quote') {
            return 'Sob Orçamento';
        }

        return $this->base_price ? number_format($this->base_price, 2, ',', '.') . ' AOA' : 'A Combinar';
    }
}
