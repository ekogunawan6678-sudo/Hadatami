<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\SensorReading;
use App\Models\RiskAnalysis;
use App\Models\Notification;
use Illuminate\Http\Request;

class MonitoringPageController extends Controller
{
    public function index()
    {
        $devices = Device::withCount([
            'sensorReadings',
            'riskAnalyses',
            'notifications'
        ])
        ->orderBy('device_name')
        ->get();

        return view('monitoring.index', compact('devices'));
    }

    public function show(Request $request, int $id)
    {
        $device = Device::findOrFail($id);

        $perPage = max(5, min((int) $request->query('per_page', 10), 100));

        $latestReading = SensorReading::where('device_id', $device->id)
            ->orderByDesc('recorded_at')
            ->first();

        $latestRisk = RiskAnalysis::where('device_id', $device->id)
            ->orderByDesc('analyzed_at')
            ->first();

        $readings = SensorReading::where('device_id', $device->id)
            ->orderByDesc('recorded_at')
            ->paginate($perPage, ['*'], 'readings_page')
            ->withQueryString();

        $riskAnalyses = RiskAnalysis::where('device_id', $device->id)
            ->orderByDesc('analyzed_at')
            ->paginate($perPage, ['*'], 'risks_page')
            ->withQueryString();

        $notifications = Notification::where('device_id', $device->id)
            ->orderByDesc('created_at')
            ->paginate($perPage, ['*'], 'notifications_page')
            ->withQueryString();

        return view('monitoring.show', compact(
            'device',
            'latestReading',
            'latestRisk',
            'readings',
            'riskAnalyses',
            'notifications'
        ));
    }
}
