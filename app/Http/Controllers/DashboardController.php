<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\SensorReading;
use App\Models\RiskAnalysis;
use App\Models\Notification;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $devices = Device::withCount([
            'sensorReadings',
            'riskAnalyses',
            'notifications'
        ])->orderBy('device_name')->get();

        $selectedDeviceId = $request->query('device_id')
            ?? $devices->first()?->id;

        $selectedDevice = $devices->firstWhere('id', (int) $selectedDeviceId);

        $latestReading = null;
        $latestRisk = null;
        $readings = collect();
        $notifications = collect();

        if ($selectedDevice) {
            $latestReading = SensorReading::where('device_id', $selectedDevice->id)
                ->orderByDesc('recorded_at')
                ->first();

            $latestRisk = RiskAnalysis::where('device_id', $selectedDevice->id)
                ->orderByDesc('analyzed_at')
                ->first();

            $readings = SensorReading::where('device_id', $selectedDevice->id)
                ->orderByDesc('recorded_at')
                ->take(20)
                ->get()
                ->sortBy('recorded_at')
                ->values();

            $notifications = Notification::where('device_id', $selectedDevice->id)
                ->orderByDesc('created_at')
                ->take(10)
                ->get();
        }

        $totalDevices = $devices->count();
        $onlineDevices = $devices->where('status', 'online')->count();
        $offlineDevices = $totalDevices - $onlineDevices;

        return view('dashboard', compact(
            'devices',
            'selectedDevice',
            'latestReading',
            'latestRisk',
            'readings',
            'notifications',
            'totalDevices',
            'onlineDevices',
            'offlineDevices'
        ));
    }
}
