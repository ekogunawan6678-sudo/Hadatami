<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Perangkat | HADATAMI</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: Arial, sans-serif; }
        body { background: #f3f6f4; color: #1f2937; }
        .sidebar { position: fixed; width: 235px; height: 100vh; background: #123b2a; color: white; padding: 25px 18px; }
        .brand { font-size: 23px; font-weight: bold; margin: 5px 10px 35px; }
        .menu-title { color: #a8c5b4; font-size: 11px; margin: 20px 10px 10px; text-transform: uppercase; }
        .menu a { display: block; padding: 12px 13px; margin: 5px 0; border-radius: 8px; color: #e5f1e9; text-decoration: none; font-size: 14px; }
        .menu a.active, .menu a:hover { background: #246044; }
        .main { margin-left: 235px; padding: 30px; }
        h1 { color: #183d2c; font-size: 25px; }
        h2 { color: #183d2c; font-size: 17px; margin-bottom: 17px; }
        .subtitle { color: #6b7280; font-size: 13px; margin-top: 7px; }
        .back { display: inline-block; color: #17613d; text-decoration: none; font-size: 13px; margin-bottom: 18px; }
        .panel { background: white; padding: 20px; border-radius: 12px; box-shadow: 0 3px 14px #00000008; margin: 20px 0; overflow-x: auto; }
        .info-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; margin-top: 18px; }
        .info { padding: 14px; background: #f8faf9; border-radius: 8px; }
        .info-label { font-size: 12px; color: #6b7280; margin-bottom: 8px; }
        .info-value { font-size: 16px; font-weight: bold; color: #174b32; overflow-wrap: anywhere; }
        .sensor-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 14px; }
        .sensor { border: 1px solid #e5e7eb; padding: 15px; border-radius: 9px; }
        .sensor-label { color: #6b7280; font-size: 12px; margin-bottom: 10px; }
        .sensor-value { font-size: 23px; font-weight: bold; color: #174b32; }
        .unit { font-size: 12px; color: #6b7280; }
        .status { display: inline-block; padding: 5px 10px; border-radius: 20px; font-size: 11px; font-weight: bold; text-transform: uppercase; }
        .online, .rendah { background: #dcfce7; color: #166534; }
        .offline { background: #fee2e2; color: #991b1b; }
        .sedang, .warning { background: #fef3c7; color: #92400e; }
        .tinggi, .critical { background: #fee2e2; color: #991b1b; }
        table { width: 100%; border-collapse: collapse; min-width: 650px; }
        th, td { text-align: left; padding: 12px; border-bottom: 1px solid #e5e7eb; font-size: 12px; }
        th { background: #f8faf9; color: #4b5563; }
        .empty { color: #6b7280; font-size: 13px; padding: 10px 0; }
        .analysis { font-size: 13px; color: #4b5563; line-height: 1.6; margin-top: 8px; }
        .notification { padding: 13px; background: #f9fafb; border-left: 4px solid #d1d5db; border-radius: 5px; margin-bottom: 10px; }
        .notification.warning { border-left-color: #d97706; }
        .notification.critical { border-left-color: #dc2626; }
        .notification-title { font-weight: bold; font-size: 13px; margin-bottom: 5px; }
        .notification-message { color: #4b5563; font-size: 12px; line-height: 1.5; }
        .notification-time { color: #9ca3af; font-size: 11px; margin-top: 6px; }
        .pagination { margin-top: 15px; font-size: 13px; }
        .pagination nav > div:first-child { margin-bottom: 10px; color: #6b7280; }
        .pagination a, .pagination span { display: inline-block; padding: 6px 10px; margin: 2px; border: 1px solid #e5e7eb; border-radius: 5px; text-decoration: none; color: #17613d; }
        @media(max-width: 900px) { .sensor-grid { grid-template-columns: repeat(2, 1fr); } }
        @media(max-width: 760px) {
            .sidebar { position: static; width: 100%; height: auto; }
            .brand { margin-bottom: 15px; }
            .menu { display: flex; flex-wrap: wrap; }
            .menu-title { display: none; }
            .main { margin-left: 0; padding: 18px; }
            .info-grid { grid-template-columns: 1fr; }
        }
        @media(max-width: 450px) { .sensor-grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
    <aside class="sidebar">
        <div class="brand">🌴 HADATAMI</div>
        <div class="menu-title">Menu Utama</div>
        <nav class="menu">
            <a href="{{ route('dashboard') }}">▦ Dashboard</a>
            <a href="{{ route('monitoring.index') }}" class="active">◉ Monitoring</a>
            <a href="{{ route('devices.index') }}">▣ Perangkat IoT</a>
            <a href="{{ route('analysis.index') }}"> ⌁ Analisis Risiko</a>
            <a href="{{ route('notifications.index') }}">♧ Notifikasi</a>
        </nav>
    </aside>

    <main class="main">
        <a href="{{ route('monitoring.index') }}" class="back">← Kembali ke Monitoring</a>

        <h1>{{ $device->device_name }}</h1>
        <p class="subtitle">Detail pemantauan dan riwayat data perangkat HADATAMI.</p>

        <section class="panel">
            <h2>Informasi Perangkat</h2>
            <div class="info-grid">
                <div class="info">
                    <div class="info-label">Kode Perangkat</div>
                    <div class="info-value">{{ $device->device_code }}</div>
                </div>
                <div class="info">
                    <div class="info-label">Lokasi</div>
                    <div class="info-value">{{ $device->location ?? 'Belum ditentukan' }}</div>
                </div>
                <div class="info">
                    <div class="info-label">Status</div>
                    <div class="info-value">
                        <span class="status {{ strtolower($device->status ?? 'offline') }}">
                            {{ $device->status ?? 'offline' }}
                        </span>
                    </div>
                </div>
                <div class="info">
                    <div class="info-label">Terakhir Terhubung</div>
                    <div class="info-value">
                        {{ $device->last_seen_at
                            ? \Carbon\Carbon::parse($device->last_seen_at)->format('d-m-Y H:i:s')
                            : 'Belum terhubung' }}
                    </div>
                </div>
                <div class="info">
                    <div class="info-label">Tanggal Terdaftar</div>
                    <div class="info-value">{{ $device->created_at?->format('d-m-Y') ?? '—' }}</div>
                </div>
                <div class="info">
                    <div class="info-label">ID Perangkat</div>
                    <div class="info-value">{{ $device->id }}</div>
                </div>
            </div>
        </section>

        <section class="panel">
            <h2>Pembacaan Sensor Terbaru</h2>
            <div class="sensor-grid">
                <div class="sensor">
                    <div class="sensor-label">Jumlah Kumbang</div>
                    <div class="sensor-value">{{ $latestReading?->beetle_count ?? '—' }} <span class="unit">ekor</span></div>
                </div>
                <div class="sensor">
                    <div class="sensor-label">Suhu</div>
                    <div class="sensor-value">
                        {{ $latestReading?->temperature !== null ? number_format($latestReading->temperature, 1) : '—' }}
                        <span class="unit">°C</span>
                    </div>
                </div>
                <div class="sensor">
                    <div class="sensor-label">Kelembapan</div>
                    <div class="sensor-value">
                        {{ $latestReading?->humidity !== null ? number_format($latestReading->humidity, 1) : '—' }}
                        <span class="unit">%</span>
                    </div>
                </div>
                <div class="sensor">
                    <div class="sensor-label">Curah Hujan</div>
                    <div class="sensor-value">
                        {{ $latestReading?->rainfall !== null ? number_format($latestReading->rainfall, 1) : '—' }}
                        <span class="unit">mm</span>
                    </div>
                </div>
            </div>
            <p class="subtitle" style="margin-top:14px">
                Waktu pembacaan:
                {{ $latestReading?->recorded_at
                    ? \Carbon\Carbon::parse($latestReading->recorded_at)->format('d-m-Y H:i:s')
                    : 'Belum ada data' }}
            </p>
        </section>

        <section class="panel">
            <h2>Riwayat Pembacaan Sensor</h2>
            @if ($readings->isEmpty())
                <p class="empty">Belum ada riwayat pembacaan sensor.</p>
            @else
                <table>
                    <thead>
                        <tr>
                            <th>Waktu</th>
                            <th>Jumlah Kumbang</th>
                            <th>Suhu (°C)</th>
                            <th>Kelembapan (%)</th>
                            <th>Curah Hujan (mm)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($readings as $reading)
                            <tr>
                                <td>{{ $reading->recorded_at ? \Carbon\Carbon::parse($reading->recorded_at)->format('d-m-Y H:i:s') : '—' }}</td>
                                <td>{{ $reading->beetle_count }}</td>
                                <td>{{ $reading->temperature ?? '—' }}</td>
                                <td>{{ $reading->humidity ?? '—' }}</td>
                                <td>{{ $reading->rainfall ?? '—' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination">{{ $readings->links() }}</div>
            @endif
        </section>

        <section class="panel">
            <h2>Riwayat Analisis Risiko</h2>
            @if ($riskAnalyses->isEmpty())
                <p class="empty">Belum ada analisis risiko untuk perangkat ini.</p>
            @else
                <table>
                    <thead>
                        <tr>
                            <th>Waktu Analisis</th>
                            <th>Tingkat Risiko</th>
                            <th>Hasil Analisis</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($riskAnalyses as $risk)
                            <tr>
                                <td>{{ $risk->analyzed_at ? \Carbon\Carbon::parse($risk->analyzed_at)->format('d-m-Y H:i:s') : '—' }}</td>
                                <td>
                                    <span class="status {{ strtolower($risk->risk_level) }}">
                                        {{ $risk->risk_level }}
                                    </span>
                                </td>
                                <td>{{ $risk->analysis }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination">{{ $riskAnalyses->links() }}</div>
            @endif
        </section>

        <section class="panel">
            <h2>Riwayat Notifikasi</h2>
            @if ($notifications->isEmpty())
                <p class="empty">Belum ada notifikasi untuk perangkat ini.</p>
            @else
                @foreach ($notifications as $notification)
                    <div class="notification {{ strtolower($notification->severity ?? '') }}">
                        <div class="notification-title">{{ $notification->title }}</div>
                        <div class="notification-message">{{ $notification->message }}</div>
                        <div class="notification-time">
                            {{ $notification->created_at?->format('d-m-Y H:i:s') ?? 'Waktu tidak tersedia' }}
                            &nbsp; | &nbsp; Status:
                            {{ $notification->read_at ? 'Sudah dibaca' : 'Belum dibaca' }}
                        </div>
                    </div>
                @endforeach
                <div class="pagination">{{ $notifications->links() }}</div>
            @endif
        </section>
    </main>
</body>
</html>
