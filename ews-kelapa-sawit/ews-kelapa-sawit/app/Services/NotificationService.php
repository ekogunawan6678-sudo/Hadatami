<?php

namespace App\Services;

use App\Models\Device;
use App\Models\Notification;
use App\Models\RiskAnalysis;

class NotificationService
{
    public function createRiskNotification(
        Device $device,
        RiskAnalysis $riskAnalysis
    ): ?Notification {
        $riskLevel = $riskAnalysis->risk_level;

        if ($riskLevel === 'sedang') {
            $title = 'Peringatan Pemantauan';
            $severity = 'warning';
            $message = 'Perangkat ' . $device->device_name
                . ' mendeteksi jumlah kumbang dalam kategori risiko sedang. '
                . 'Lakukan pemantauan dan pemeriksaan lapangan lebih lanjut.';
        } elseif ($riskLevel === 'tinggi') {
            $title = 'Peringatan Risiko Tinggi';
            $severity = 'critical';
            $message = 'Perangkat ' . $device->device_name
                . ' mendeteksi jumlah kumbang dalam kategori risiko tinggi. '
                . 'Segera lakukan pemeriksaan lapangan untuk memverifikasi kondisi.';
        } else {
            return null;
        }

        return Notification::create([
            'device_id' => $device->id,
            'risk_analysis_id' => $riskAnalysis->id,
            'title' => $title,
            'message' => $message,
            'severity' => $severity,
            'sent_at' => null,
            'read_at' => null,
        ]);
    }
}
