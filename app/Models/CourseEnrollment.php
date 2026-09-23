<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CourseEnrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'customer_id',
        'order_id',
        'status',
        'enrolled_at',
        'completed_at'
    ];

    protected $casts = [
        'enrolled_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function progress(): HasMany
    {
        return $this->hasMany(CourseProgress::class, 'enrollment_id');
    }

    public function getProgressPercentageAttribute(): int
    {
        $totalLessons = $this->course->lessons()->count();
        if ($totalLessons === 0) {
            return 0;
        }

        $completedLessons = $this->progress()->where('completed', true)->count();
        return (int) round(($completedLessons / $totalLessons) * 100);
    }
}
