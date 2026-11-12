<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring Perangkat | HADATAMI</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: Arial, sans-serif; }
        body { background: #f3f6f4; color: #1f2937; }
        .sidebar { position: fixed; width: 235px; height: 100vh; background: #123b2a; color: white; padding: 25px 18px; }
        .brand { font-size: 23px; font-weight: bold; margin: 5px 10px 35px; }
        .menu-title { color: #a8c5b4; font-size: 11px; margin: 20px 10px 10px; text-transform: uppercase; }
        .menu a { display: block; padding: 12px 13px; margin: 5px 0; border-radius: 8px; color: #e5f1e9; text-decoration: none; font-size: 14px; }
        .menu a.active, .menu a:hover { background: #246044; color: white; }
        .main { margin-left: 235px; padding: 30px; }
        h1 { color: #183d2c; font-size: 25px; }
        .subtitle { color: #6b7280; font-size: 13px; margin-top: 7px; }
        .summary { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin: 25px 0; }
        .card, .panel { background: white; padding: 20px; border-radius: 12px; box-shadow: 0 3px 14px #00000008; }
        .card-label { color: #6b7280; font-size: 13px; margin-bottom: 10px; }
        .card-value { font-size: 27px; font-weight: bold; color: #174b32; }
        .panel { overflow-x: auto; }
        .panel h2 { font-size: 17px; color: #183d2c; margin-bottom: 18px; }
        table { width: 100%; border-collapse: collapse; min-width: 700px; }
        th, td { text-align: left; padding: 13px 12px; border-bottom: 1px solid #e5e7eb; font-size: 13px; }
        th { background: #f8faf9; color: #4b5563; }
        .status { display: inline-block; padding: 5px 10px; border-radius: 20px; font-size: 11px; font-weight: bold; text-transform: uppercase; }
        .online, .rendah { background: #dcfce7; color: #166534; }
        .offline { background: #fee2e2; color: #991b1b; }
        .sedang, .warning { background: #fef3c7; color: #92400e; }
        .tinggi, .critical { background: #fee2e2; color: #991b1b; }
        .action { display: inline-block; background: #17613d; color: white; padding: 8px 11px; border-radius: 6px; text-decoration: none; font-size: 12px; }
        .empty { padding: 20px 0; color: #6b7280; font-size: 13px; }
        @media(max-width: 760px) {
            .sidebar { position: static; width: 100%; height: auto; }
            .brand { margin-bottom: 15px; }
            .menu { display: flex; flex-wrap: wrap; }
            .menu-title { display: none; }
            .main { margin-left: 0; padding: 18px; }
            .summary { grid-template-columns: 1fr; }
        }
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
            <form
            action="{{ route('logout') }}"
            method="POST"
            style="margin-top: 20px;"
                >
                    @csrf

                    <button
                    type="submit"
                    class="logout-btn"
                    >
                    ⇥ Logout
                </button>
            </form>
        </nav>
    </aside>

    <main class="main">
        <h1>Monitoring Perangkat</h1>
        <p class="subtitle">Daftar perangkat IoT dan ringkasan data pemantauan tanaman kelapa sawit.</p>

        @php
            $total = $devices->count();
            $online = $devices->where('status', 'online')->count();
            $offline = $total - $online;
        @endphp

        <section class="summary">
            <div class="card">
                <div class="card-label">Total Perangkat</div>
                <div class="card-value">{{ $total }}</div>
            </div>
            <div class="card">
                <div class="card-label">Perangkat Online</div>
                <div class="card-value">{{ $online }}</div>
            </div>
            <div class="card">
                <div class="card-label">Perangkat Offline</div>
                <div class="card-value">{{ $offline }}</div>
            </div>
        </section>

        <section class="panel">
            <h2>Daftar Perangkat Terdaftar</h2>

            @if ($devices->isEmpty())
                <p class="empty">Belum ada perangkat yang terdaftar. Tambahkan perangkat melalui database atau fitur manajemen perangkat pada tahap berikutnya.</p>
            @else
                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Perangkat</th>
                            <th>Kode Perangkat</th>
                            <th>Lokasi</th>
                            <th>Status</th>
                            <th>Jumlah Data</th>
                            <th>Pembaruan Terakhir</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($devices as $index => $device)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $device->device_name }}</td>
                                <td>{{ $device->device_code }}</td>
                                <td>{{ $device->location ?? '—' }}</td>
                                <td>
                                    <span class="status {{ strtolower($device->status ?? 'offline') }}">
                                        {{ $device->status ?? 'offline' }}
                                    </span>
                                </td>
                                <td>{{ $device->sensor_readings_count }}</td>
                                <td>
                                    {{ $device->last_seen_at
                                        ? \Carbon\Carbon::parse($device->last_seen_at)->format('d-m-Y H:i')
                                        : 'Belum terhubung' }}
                                </td>
                                <td>
                                    <a class="action" href="{{ route('monitoring.show', $device->id) }}">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </section>
    </main>
</body>
</html>
