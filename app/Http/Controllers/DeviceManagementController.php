<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class DeviceManagementController extends Controller
{
    private function ensureAdmin(): void
    {
        abort_unless(
            Auth::check() && Auth::user()?->role === 'admin',
            403,
            'Anda tidak memiliki izin untuk mengelola perangkat.'
        );
    }

    public function index()
    {
        $this->ensureAdmin();

        $devices = Device::withCount([
            'sensorReadings',
            'riskAnalyses',
            'notifications',
        ])
        ->orderBy('device_name')
        ->paginate(10);

        return view('devices.index', compact('devices'));
    }

    public function create()
    {
        $this->ensureAdmin();

        return view('devices.create');
    }

    public function store(Request $request)
    {
        $this->ensureAdmin();

        $validated = $request->validate([
            'device_code' => [
                'required',
                'string',
                'max:50',
                'unique:devices,device_code',
            ],
            'device_name' => [
                'required',
                'string',
                'max:100',
            ],
            'location' => [
                'nullable',
                'string',
                'max:255',
            ],
        ]);

        $validated['status'] = 'offline';

        Device::create($validated);

        return redirect()
            ->route('devices.index')
            ->with('success', 'Perangkat berhasil ditambahkan.');
    }

    public function edit(Device $device)
    {
        $this->ensureAdmin();

        return view('devices.edit', compact('device'));
    }

    public function update(Request $request, Device $device)
    {
        $this->ensureAdmin();

        $validated = $request->validate([
            'device_code' => [
                'required',
                'string',
                'max:50',
                Rule::unique('devices', 'device_code')->ignore($device->id),
            ],
            'device_name' => [
                'required',
                'string',
                'max:100',
            ],
            'location' => [
                'nullable',
                'string',
                'max:255',
            ],
        ]);

        // Status dan last_seen_at tidak diubah melalui form.
        $device->update($validated);

        return redirect()
            ->route('devices.index')
            ->with('success', 'Informasi perangkat berhasil diperbarui.');
    }

    public function destroy(Device $device)
    {
        $this->ensureAdmin();

        // Melindungi riwayat sensor dan analisis yang sudah tersimpan.
        if (
            $device->sensorReadings()->exists()
            || $device->riskAnalyses()->exists()
            || $device->notifications()->exists()
        ) {
            return redirect()
                ->route('devices.index')
                ->with('error', 'Perangkat memiliki riwayat data sehingga tidak dapat dihapus. Pertahankan perangkat untuk menjaga riwayat monitoring.');
        }

        $device->delete();

        return redirect()
            ->route('devices.index')
            ->with('success', 'Perangkat berhasil dihapus.');
    }
}
