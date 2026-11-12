<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Models\SensorReading;
use App\Models\RiskAnalysis;
use App\Models\Notification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    /**
     * Mengambil daftar perangkat.
     */
    public function devices(): JsonResponse
    {
        $devices = Device::query()
            ->select([
                'id',
                'device_code',
                'device_name',
                'location',
                'status',
                'last_seen_at',
                'created_at',
            ])
            ->withCount([
                'sensorReadings',
                'riskAnalyses',
                'notifications',
            ])
            ->orderBy('device_name')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar perangkat berhasil diambil.',
            'data' => $devices,
        ]);
    }

    /**
     * Mengambil riwayat pembacaan sensor perangkat.
     */
    public function readings(Request $request, int $id): JsonResponse
    {
        $device = Device::findOrFail($id);

        $perPage = $request->integer('per_page', 20);
        $perPage = max(1, min($perPage, 100));

        $readings = SensorReading::where('device_id', $device->id)
            ->orderByDesc('recorded_at')
            ->paginate($perPage);

        return response()->json([
            'success' => true,
            'message' => 'Riwayat sensor berhasil diambil.',
            'device' => $device,
            'data' => $readings,
        ]);
    }

    /**
     * Mengambil riwayat analisis risiko perangkat.
     */
    public function riskAnalyses(Request $request, int $id): JsonResponse
    {
        $device = Device::findOrFail($id);

        $perPage = $request->integer('per_page', 20);
        $perPage = max(1, min($perPage, 100));

        $analyses = RiskAnalysis::where('device_id', $device->id)
            ->with('sensorReading:id,beetle_count,temperature,humidity,rainfall,recorded_at')
            ->orderByDesc('analyzed_at')
            ->paginate($perPage);

        return response()->json([
            'success' => true,
            'message' => 'Riwayat analisis risiko berhasil diambil.',
            'device' => $device,
            'data' => $analyses,
        ]);
    }

    /**
     * Mengambil daftar notifikasi perangkat.
     */
    public function notifications(Request $request, int $id): JsonResponse
    {
        $device = Device::findOrFail($id);

        $perPage = $request->integer('per_page', 20);
        $perPage = max(1, min($perPage, 100));

        $notifications = Notification::where('device_id', $device->id)
            ->with('riskAnalysis:id,risk_level,analyzed_at')
            ->orderByDesc('created_at')
            ->paginate($perPage);

        return response()->json([
            'success' => true,
            'message' => 'Notifikasi berhasil diambil.',
            'device' => $device,
            'data' => $notifications,
        ]);
    }
}
