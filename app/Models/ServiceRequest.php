<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class ServiceRequest extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'protocol',
        'customer_id',
        'business_unit_id',
        'service_id',
        'assigned_to',
        'title',
        'description',
        'priority',
        'status',
        'requested_date',
        'estimated_date',
        'completed_at',
        'cancelled_at'
    ];

    protected $casts = [
        'requested_date' => 'date',
        'estimated_date' => 'date',
        'completed_at' => 'datetime',
        'cancelled_at' => 'datetime',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function businessUnit(): BelongsTo
    {
        return $this->belongsTo(BusinessUnit::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function assignedEmployee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'assigned_to');
    }

    public function statusHistories(): HasMany
    {
        return $this->hasMany(ServiceRequestStatusHistory::class)->orderByDesc('created_at');
    }

    public function quotes(): HasMany
    {
        return $this->hasMany(Quote::class);
    }

    public function latestQuote(): HasOne
    {
        return $this->hasOne(Quote::class)->latestOfMany();
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class)->orderBy('created_at');
    }

    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function review(): HasOne
    {
        return $this->hasOne(Review::class);
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'new' => 'Nova',
            'in_analysis' => 'Em Análise',
            'waiting_customer' => 'Aguardando Cliente',
            'quoted' => 'Orçado',
            'approved' => 'Aprovado',
            'in_progress' => 'Em Execução',
            'in_review' => 'Em Revisão',
            'completed' => 'Concluída',
            'cancelled' => 'Cancelada',
            default => ucfirst($this->status)
        };
    }

    public function getPriorityBadgeColorAttribute(): string
    {
        return match($this->priority) {
            'urgent' => 'bg-red-500 text-white',
            'high' => 'bg-amber-500 text-white',
            'normal' => 'bg-blue-500 text-white',
            'low' => 'bg-slate-400 text-white',
            default => 'bg-slate-500 text-white'
        };
    }
}
