<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'description', 'deadline', 'status', 'created_at'];

    protected $casts = [
        'deadline' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Returns how many days are left until the deadline (negative = overdue).
     */
    public function getDaysLeftAttribute(): int
    {
        return (int) Carbon::today()->diffInDays(Carbon::parse($this->deadline), false);
    }

    /**
     * Returns panic level based on days left.
     */
    public function getPanicLevelAttribute(): array
    {
        $days = $this->days_left;

        if ($days < 0)  return ['label' => 'CRITICAL', 'color' => 'critical', 'icon' => '🤯'];
        if ($days <= 1) return ['label' => 'HIGH',     'color' => 'high',     'icon' => '🤬'];
        if ($days <= 3) return ['label' => 'MEDIUM',   'color' => 'medium',   'icon' => '😡'];
        return           ['label' => 'LOW',      'color' => 'low',      'icon' => '😩'];
    }

    /**
     * Calculates "time used %" based on task age vs total duration.
     */
    public function getTimeUsedAttribute(): int
    {
        $created = Carbon::parse($this->created_at);
        $deadline = Carbon::parse($this->deadline);
        $now = Carbon::now();

        $total = $created->diffInHours($deadline);
        if ($total <= 0) return 100;

        $used = $created->diffInHours($now);
        return min(100, (int) round(($used / $total) * 100));
    }

    /**
     * Returns panic percentage (0–100) for stats display.
     */
    public function getPanicPercentAttribute(): int
    {
        return $this->time_used;
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }
}