<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RiskAnalysis extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_id',
        'sensor_reading_id',
        'risk_level',
        'analysis',
        'analyzed_at',
    ];

    protected function casts(): array
    {
        return [
            'analyzed_at' => 'datetime',
        ];
    }

    public function device(): BelongsTo
    {
        return $this->belongsTo(Device::class);
    }

    public function sensorReading(): BelongsTo
    {
       return $this->belongsTo(
            SensorReading::class,
            'sensor_reading_id'
        );
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class);
    }
}
