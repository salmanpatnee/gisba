<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseEnrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'course',
        'name',
        'email',
        'amount',
        'currency',
        'paypal_order_id',
        'status',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    /** @param Builder<CourseEnrollment> $query */
    public function scopeForCourse(Builder $query, string $course): void
    {
        $query->where('course', $course);
    }
}
