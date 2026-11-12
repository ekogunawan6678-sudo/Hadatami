<?php

namespace App\Services;

use App\Models\Device;
use App\Models\RiskAnalysis;
use App\Models\SensorReading;

class RiskAnalysisService
{
    public function analyze(
        Device $device,
        SensorReading $reading
    ): RiskAnalysis {
        $beetleCount = (int) $reading->beetle_count;

        if ($beetleCount >= 10) {
            $riskLevel = 'tinggi';
            $analysis = 'Jumlah kumbang terdeteksi berada pada kategori tinggi berdasarkan aturan uji. Diperlukan pemeriksaan lapangan lebih lanjut.';
        } elseif ($beetleCount >= 5) {
            $riskLevel = 'sedang';
            $analysis = 'Jumlah kumbang terdeteksi berada pada kategori sedang berdasarkan aturan uji. Lakukan pemantauan lanjutan.';
        } else {
            $riskLevel = 'rendah';
            $analysis = 'Jumlah kumbang terdeteksi berada pada kategori rendah berdasarkan aturan uji. Lanjutkan pemantauan secara berkala.';
        }

        return RiskAnalysis::create([
            'device_id' => $device->id,
            'sensor_reading_id' => $reading->id,
            'risk_level' => $riskLevel,
            'analysis' => $analysis,
            'analyzed_at' => now(),
        ]);
    }
}
