<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SensorReading extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_id',
        'beetle_count',
        'temperature',
        'humidity',
        'rainfall',
        'recorded_at',
    ];

    protected function casts(): array
    {
        return [
            'beetle_count' => 'integer',
            'temperature' => 'decimal:2',
            'humidity' => 'decimal:2',
            'rainfall' => 'decimal:2',
            'recorded_at' => 'datetime',
        ];
    }

    public function device(): BelongsTo
    {
        return $this->belongsTo(Device::class);
    }

    public function riskAnalyses(): HasMany
    {
        return $this->hasMany(RiskAnalysis::class);
    }
}
