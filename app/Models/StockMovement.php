<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class StockMovement extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'user_id',
        'type',
        'quantity',
        'previous_quantity',
        'current_quantity',
        'reason',
        'reference_type',
        'reference_id',
        'created_at'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'quantity' => 'integer',
        'previous_quantity' => 'integer',
        'current_quantity' => 'integer',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function reference(): MorphTo
    {
        return $this->morphTo();
    }
}
