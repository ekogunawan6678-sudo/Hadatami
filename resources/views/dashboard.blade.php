<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Monitoring | HADATAMI</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f3f6f4;
            color: #1f2937;
        }

        .sidebar {
            position: fixed;
            width: 245px;
            height: 100vh;
            background: #123b2a;
            color: white;
            padding: 25px 18px;
        }

        .brand {
            font-size: 23px;
            font-weight: bold;
            margin: 5px 10px 35px;
            letter-spacing: 1px;
        }

        .menu-title {
            color: #a8c5b4;
            font-size: 11px;
            margin: 20px 10px 10px;
            text-transform: uppercase;
        }

        .menu a {
            display: block;
            padding: 12px 13px;
            margin: 5px 0;
            border-radius: 8px;
            color: #e5f1e9;
            text-decoration: none;
            font-size: 14px;
        }

        .menu a.active,
        .menu a:hover {
            background: #246044;
            color: white;
        }

        .main {
            margin-left: 245px;
            padding: 28px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
        }

        .topbar h1 {
            font-size: 25px;
            color: #183d2c;
        }

        .subtitle {
            color: #6b7280;
            font-size: 13px;
            margin-top: 6px;
        }

        .device-form {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        select, .btn {
            padding: 10px 12px;
            border: 1px solid #d1d5db;
            border-radius: 7px;
            background: white;
            font-size: 13px;
        }

        .btn {
            background: #17613d;
            color: white;
            border: none;
            cursor: pointer;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px;
            margin-bottom: 22px;
        }

        .card, .panel {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 3px 14px rgba(0,0,0,.04);
        }

        .card-label {
            color: #6b7280;
            font-size: 13px;
            margin-bottom: 12px;
        }

        .card-value {
            color: #173d2c;
            font-size: 27px;
            font-weight: bold;
        }

        .card-note {
            color: #6b7280;
            font-size: 12px;
            margin-top: 8px;
        }

        .content-grid {
            display: grid;
            grid-template-columns: 1.6fr 1fr;
            gap: 18px;
            margin-bottom: 20px;
        }

        .panel {
            min-width: 0;
        }

        .panel h2 {
            color: #183d2c;
            font-size: 16px;
            margin-bottom: 18px;
        }

        .sensor-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 13px;
        }

        .sensor-box {
            padding: 15px;
            border: 1px solid #e5e7eb;
            border-radius: 9px;
            background: #fbfdfb;
        }

        .sensor-name {
            color: #6b7280;
            font-size: 12px;
            margin-bottom: 10px;
        }

        .sensor-value {
            font-size: 23px;
            font-weight: bold;
            color: #174b32;
        }

        .sensor-unit {
            font-size: 12px;
            color: #6b7280;
        }

        .status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .online, .rendah {
            background: #dcfce7;
            color: #166534;
        }

        .offline {
            background: #fee2e2;
            color: #991b1b;
        }

        .sedang, .warning {
            background: #fef3c7;
            color: #92400e;
        }

        .tinggi, .critical {
            background: #fee2e2;
            color: #991b1b;
        }

        .risk-description {
            color: #4b5563;
            font-size: 13px;
            line-height: 1.6;
            margin-top: 13px;
        }

        .chart-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
            margin-bottom: 20px;
        }

        .chart-container {
            position: relative;
            height: 260px;
        }

        .notification {
            border-left: 4px solid #d1d5db;
            background: #f9fafb;
            padding: 12px;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        .notification.warning {
            border-left-color: #d97706;
        }

        .notification.critical {
            border-left-color: #dc2626;
        }

        .notification-title {
            font-weight: bold;
            font-size: 13px;
            margin-bottom: 5px;
        }

        .notification-message {
            color: #4b5563;
            font-size: 12px;
            line-height: 1.5;
        }

        .notification-time {
            color: #9ca3af;
            font-size: 11px;
            margin-top: 6px;
        }

        .empty {
            color: #6b7280;
            font-size: 13px;
            padding: 12px 0;
        }

        .device-info {
            font-size: 13px;
            color: #6b7280;
            margin-bottom: 15px;
        }

        @media (max-width: 1100px) {
            .cards {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .content-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 760px) {
            .sidebar {
                position: static;
                width: 100%;
                height: auto;
            }

            .brand {
                margin-bottom: 15px;
            }

            .menu {
                display: flex;
                flex-wrap: wrap;
            }

            .menu-title {
                display: none;
            }

            .main {
                margin-left: 0;
                padding: 18px;
            }

            .topbar {
                align-items: flex-start;
                flex-direction: column;
            }

            .chart-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 450px) {
            .cards, .sensor-grid {
                grid-template-columns: 1fr;
            }

            .device-form {
                width: 100%;
            }

            .device-form select {
                flex: 1;
                min-width: 0;
            }
        }
    </style>
</head>

<body>
    <aside class="sidebar">
        <div class="brand">🌴 HADATAMI</div>

        <div class="menu-title">Menu Utama</div>
        <nav class="menu">
            <a href="{{ route('dashboard') }}" class="active">▦ Dashboard</a>
            <a href="{{ route('monitoring.index') }}">◉ Monitoring</a>
            <a href="{{ route('devices.index') }}">▣ Perangkat IoT</a>
            <a href="{{ route('analysis.index') }}"> ⌁ Analisis Risiko</a>
            <a href="{{ route('notifications.index') }}">♧ Notifikasi</a>
            <form
            action="{{ route('logout') }}"
            method="POST"
            style="margin-top: 20px;"
                    >
             @csrf
                <button
                type="submit"
                style="
                    width: 100%;
                    padding: 12px 13px;
                    border: none;
                    border-radius: 8px;
                    background: transparent;
                    color: #e5f1e9;
                    text-align: left;
                    cursor: pointer;
                    font-size: 14px;
                     "
                     >
                    ⇥ Logout
                </button>
            </form>
        </nav>
    </aside>

    <main class="main">
        <div class="topbar">
            <div>
                <h1>Dashboard Monitoring</h1>
                <p class="subtitle">Sistem pemantauan dini risiko kumbang pada tanaman kelapa sawit</p>
            </div>

            <form class="device-form" method="GET" action="{{ route('dashboard') }}">
                <select name="device_id" onchange="this.form.submit()">
                    @forelse ($devices as $device)
                        <option value="{{ $device->id }}"
                            {{ $selectedDevice && $selectedDevice->id == $device->id ? 'selected' : '' }}>
                            {{ $device->device_name }}
                        </option>
                    @empty
                        <option value="">Belum ada perangkat</option>
                    @endforelse
                </select>
                <button class="btn" type="submit">Pilih</button>
            </form>
        </div>

        <section class="cards">
            <div class="card">
                <div class="card-label">Total Perangkat</div>
                <div class="card-value">{{ $totalDevices }}</div>
                <div class="card-note">Perangkat terdaftar</div>
            </div>

            <div class="card">
                <div class="card-label">Perangkat Online</div>
                <div class="card-value">{{ $onlineDevices }}</div>
                <div class="card-note">Status perangkat</div>
            </div>

            <div class="card">
                <div class="card-label">Perangkat Offline</div>
                <div class="card-value">{{ $offlineDevices }}</div>
                <div class="card-note">Status perangkat</div>
            </div>

            <div class="card">
                <div class="card-label">Jumlah Kumbang Terakhir</div>
                <div class="card-value">{{ $latestReading?->beetle_count ?? '—' }}</div>
                <div class="card-note">Hasil pembacaan terakhir</div>
            </div>
        </section>

        @if ($selectedDevice)
            <p class="device-info">
                Perangkat: <strong>{{ $selectedDevice->device_name }}</strong>
                &nbsp; | &nbsp; Kode: {{ $selectedDevice->device_code }}
                &nbsp; | &nbsp; Lokasi: {{ $selectedDevice->location ?? 'Belum ditentukan' }}
                &nbsp; | &nbsp; Status:
                <span class="status {{ strtolower($selectedDevice->status ?? 'offline') }}">
                    {{ $selectedDevice->status ?? 'offline' }}
                </span>
            </p>

            <section class="content-grid">
                <div class="panel">
                    <h2>Parameter Sensor Terbaru</h2>

                    <div class="sensor-grid">
                        <div class="sensor-box">
                            <div class="sensor-name">Jumlah Kumbang</div>
                            <div class="sensor-value">
                                {{ $latestReading?->beetle_count ?? '—' }}
                                <span class="sensor-unit">ekor</span>
                            </div>
                        </div>

                        <div class="sensor-box">
                            <div class="sensor-name">Suhu</div>
                            <div class="sensor-value">
                                {{ $latestReading?->temperature !== null ? number_format($latestReading->temperature, 1) : '—' }}
                                <span class="sensor-unit">°C</span>
                            </div>
                        </div>

                        <div class="sensor-box">
                            <div class="sensor-name">Kelembapan</div>
                            <div class="sensor-value">
                                {{ $latestReading?->humidity !== null ? number_format($latestReading->humidity, 1) : '—' }}
                                <span class="sensor-unit">%</span>
                            </div>
                        </div>

                        <div class="sensor-box">
                            <div class="sensor-name">Curah Hujan</div>
                            <div class="sensor-value">
                                {{ $latestReading?->rainfall !== null ? number_format($latestReading->rainfall, 1) : '—' }}
                                <span class="sensor-unit">mm</span>
                            </div>
                        </div>
                    </div>

                    <p class="subtitle" style="margin-top:15px">
                        Waktu pembacaan:
                        {{ $latestReading?->recorded_at
                            ? \Carbon\Carbon::parse($latestReading->recorded_at)->format('d-m-Y H:i:s')
                            : 'Belum ada data' }}
                    </p>
                </div>

                <div class="panel">
                    <h2>Analisis Risiko Terbaru</h2>

                    @if ($latestRisk)
                        <span class="status {{ strtolower($latestRisk->risk_level) }}">
                            {{ $latestRisk->risk_level }}
                        </span>

                        <p class="risk-description">
                            {{ $latestRisk->analysis }}
                        </p>

                        <p class="subtitle" style="margin-top:12px">
                            Dianalisis:
                            {{ $latestRisk->analyzed_at
                                ? \Carbon\Carbon::parse($latestRisk->analyzed_at)->format('d-m-Y H:i:s')
                                : 'Waktu tidak tersedia' }}
                        </p>
                    @else
                        <p class="empty">Belum tersedia analisis risiko untuk perangkat ini.</p>
                    @endif
                </div>
            </section>

            <section class="chart-grid">
                <div class="panel">
                    <h2>Grafik Jumlah Kumbang</h2>
                    <div class="chart-container"><canvas id="beetleChart"></canvas></div>
                </div>

                <div class="panel">
                    <h2>Grafik Suhu</h2>
                    <div class="chart-container"><canvas id="temperatureChart"></canvas></div>
                </div>

                <div class="panel">
                    <h2>Grafik Kelembapan</h2>
                    <div class="chart-container"><canvas id="humidityChart"></canvas></div>
                </div>

                <div class="panel">
                    <h2>Grafik Curah Hujan</h2>
                    <div class="chart-container"><canvas id="rainfallChart"></canvas></div>
                </div>
            </section>

            <section class="panel">
                <h2>Notifikasi Terbaru</h2>

                @forelse ($notifications as $notification)
                    <div class="notification {{ strtolower($notification->severity ?? '') }}">
                        <div class="notification-title">{{ $notification->title }}</div>
                        <div class="notification-message">{{ $notification->message }}</div>
                        <div class="notification-time">
                            {{ $notification->created_at?->format('d-m-Y H:i:s') }}
                        </div>
                    </div>
                @empty
                    <p class="empty">Belum ada notifikasi untuk perangkat ini.</p>
                @endforelse
            </section>
        @else
            <section class="panel">
                <h2>Perangkat Belum Tersedia</h2>
                <p class="empty">Tambahkan perangkat IoT terlebih dahulu agar data monitoring dapat ditampilkan.</p>
            </section>
        @endif
    </main>

    @if ($selectedDevice)
        <script>
            const readings = @json($readings);

            const labels = readings.map(item => {
                if (!item.recorded_at) return '-';
                return new Date(item.recorded_at).toLocaleString('id-ID');
            });

            function createLineChart(canvasId, label, field, unit) {
                const values = readings.map(item => item[field] === null ? null : Number(item[field]));

                new Chart(document.getElementById(canvasId), {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: label,
                            data: values,
                            borderWidth: 2,
                            tension: 0.3,
                            fill: false,
                            spanGaps: true
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: true }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: unit
                                }
                            },
                            x: {
                                ticks: {
                                    maxRotation: 45,
                                    minRotation: 0,
                                    maxTicksLimit: 6
                                }
                            }
                        }
                    }
                });
            }

            createLineChart('beetleChart', 'Jumlah Kumbang', 'beetle_count', 'Ekor');
            createLineChart('temperatureChart', 'Suhu', 'temperature', '°C');
            createLineChart('humidityChart', 'Kelembapan', 'humidity', '%');
            createLineChart('rainfallChart', 'Curah Hujan', 'rainfall', 'mm');
        </script>
    @endif
</body>
</html>
