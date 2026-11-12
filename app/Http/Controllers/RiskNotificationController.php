<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\RiskAnalysis;
use App\Models\Notification;
use Illuminate\Http\Request;

class RiskNotificationController extends Controller
{
    public function analysisIndex(Request $request)
    {
        $deviceId = $request->query('device_id');

        $query = RiskAnalysis::with([
            'device',
            'sensorReading'
        ])->orderByDesc('analyzed_at');

        if ($deviceId) {
            $query->where('device_id', $deviceId);
        }

        $riskAnalyses = $query
            ->paginate(15)
            ->withQueryString();

        $devices = Device::orderBy('device_name')->get();

        $totalRisk = RiskAnalysis::count();

        $lowRisk = RiskAnalysis::where('risk_level', 'rendah')->count();

        $mediumRisk = RiskAnalysis::where('risk_level', 'sedang')->count();

        $highRisk = RiskAnalysis::where('risk_level', 'tinggi')->count();

        return view('analysis.index', compact(
            'riskAnalyses',
            'devices',
            'deviceId',
            'totalRisk',
            'lowRisk',
            'mediumRisk',
            'highRisk'
        ));
    }

    public function notificationsIndex(Request $request)
    {
        $deviceId = $request->query('device_id');

        $query = Notification::with([
            'device',
            'riskAnalysis'
        ])->orderByDesc('created_at');

        if ($deviceId) {
            $query->where('device_id', $deviceId);
        }

        $notifications = $query
            ->paginate(15)
            ->withQueryString();

        $devices = Device::orderBy('device_name')->get();

        $totalNotifications = Notification::count();

        $unreadNotifications = Notification::whereNull('read_at')->count();

        $criticalNotifications = Notification::where(
            'severity',
            'critical'
        )->count();

        $warningNotifications = Notification::where(
            'severity',
            'warning'
        )->count();

        return view('notifications.index', compact(
            'notifications',
            'devices',
            'deviceId',
            'totalNotifications',
            'unreadNotifications',
            'criticalNotifications',
            'warningNotifications'
        ));
    }

    public function markAsRead(Notification $notification)
    {
        $notification->update([
            'read_at' => now(),
        ]);

        return back()->with(
            'success',
            'Notifikasi berhasil ditandai sebagai sudah dibaca.'
        );
    }

    public function markAllAsRead()
    {
        Notification::whereNull('read_at')->update([
            'read_at' => now(),
        ]);

        return back()->with(
            'success',
            'Semua notifikasi berhasil ditandai sebagai sudah dibaca.'
        );
    }
}
