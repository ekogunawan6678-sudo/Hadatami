<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Models\SensorReading;
use App\Services\RiskAnalysisService;
use App\Services\NotificationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SensorDataController extends Controller
{
    public function __construct(
        private RiskAnalysisService $riskAnalysisService,
        private NotificationService $notificationService
    ) {
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'device_code' => ['required', 'string', 'max:50'],
            'beetle_count' => ['required', 'integer', 'min:0'],
            'temperature' => ['nullable', 'numeric'],
            'humidity' => ['nullable', 'numeric', 'between:0,100'],
            'rainfall' => ['nullable', 'numeric', 'min:0'],
            'recorded_at' => ['nullable', 'date'],
        ]);

        $device = Device::where(
            'device_code',
            $validated['device_code']
        )->first();

        if (!$device) {
            return response()->json([
                'success' => false,
                'message' => 'Perangkat tidak ditemukan.',
            ], 404);
        }

        $result = DB::transaction(function () use (
            $device,
            $validated
        ) {
            $reading = SensorReading::create([
                'device_id' => $device->id,
                'beetle_count' => $validated['beetle_count'],
                'temperature' => $validated['temperature'] ?? null,
                'humidity' => $validated['humidity'] ?? null,
                'rainfall' => $validated['rainfall'] ?? null,
                'recorded_at' => $validated['recorded_at'] ?? now(),
            ]);

            $device->update([
                'status' => 'online',
                'last_seen_at' => now(),
            ]);

            $riskAnalysis = $this->riskAnalysisService->analyze(
                $device,
                $reading
            );

            $notification = $this->notificationService
                ->createRiskNotification($device, $riskAnalysis);

            return [
                'reading' => $reading,
                'risk_analysis' => $riskAnalysis,
                'notification' => $notification,
            ];
        });

        return response()->json([
            'success' => true,
            'message' => 'Data sensor berhasil diproses.',
            'data' => $result['reading'],
            'risk_analysis' => $result['risk_analysis'],
            'notification' => $result['notification'],
        ], 201);
    }
}
