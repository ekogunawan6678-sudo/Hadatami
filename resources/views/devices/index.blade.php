<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Perangkat | HADATAMI</title>
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
        .top { display: flex; justify-content: space-between; align-items: center; gap: 15px; margin-bottom: 25px; }
        .panel { background: white; padding: 20px; border-radius: 12px; box-shadow: 0 3px 14px #00000008; overflow-x: auto; }
        .btn { display: inline-block; padding: 10px 13px; border: 0; border-radius: 6px; background: #17613d; color: white; text-decoration: none; font-size: 12px; cursor: pointer; }
        .btn-edit { background: #2563eb; }
        .btn-delete { background: #dc2626; }
        table { width: 100%; border-collapse: collapse; min-width: 850px; }
        th, td { padding: 13px 11px; border-bottom: 1px solid #e5e7eb; text-align: left; font-size: 12px; }
        th { background: #f8faf9; color: #4b5563; }
        .status { display: inline-block; padding: 5px 10px; border-radius: 20px; font-size: 11px; font-weight: bold; text-transform: uppercase; }
        .online { background: #dcfce7; color: #166534; }
        .offline { background: #fee2e2; color: #991b1b; }
        .alert { padding: 12px 14px; border-radius: 7px; margin-bottom: 15px; font-size: 13px; }
        .success { background: #dcfce7; color: #166534; }
        .error { background: #fee2e2; color: #991b1b; }
        .actions { display: flex; align-items: center; gap: 6px; }
        .actions form { display: inline; }
        .pagination { margin-top: 15px; font-size: 13px; }
        .pagination nav > div:first-child { margin-bottom: 10px; color: #6b7280; }
        .pagination a, .pagination span { display: inline-block; padding: 6px 10px; margin: 2px; border: 1px solid #e5e7eb; border-radius: 5px; text-decoration: none; color: #17613d; }
        .empty { color: #6b7280; font-size: 13px; padding: 15px 0; }
        @media(max-width: 760px) {
            .sidebar { position: static; width: 100%; height: auto; }
            .brand { margin-bottom: 15px; }
            .menu { display: flex; flex-wrap: wrap; }
            .menu-title { display: none; }
            .main { margin-left: 0; padding: 18px; }
            .top { align-items: flex-start; flex-direction: column; }
        }
    </style>
</head>
<body>
    <aside class="sidebar">
        <div class="brand">🌴 HADATAMI</div>
        <div class="menu-title">Menu Utama</div>
        <nav class="menu">
            <a href="{{ route('dashboard') }}">▦ Dashboard</a>
            <a href="{{ route('monitoring.index') }}">◉ Monitoring</a>
            <a href="{{ route('devices.index') }}" class="active">▣ Perangkat IoT</a>
            <a href="{{ route('monitoring.index') }}">⌁ Analisis Risiko</a>
            <a href="{{ route('monitoring.index') }}">♧ Notifikasi</a>
        </nav>
    </aside>

    <main class="main">
        <div class="top">
            <div>
                <h1>Manajemen Perangkat IoT</h1>
                <p class="subtitle">Kelola perangkat ESP32 yang terhubung dengan HADATAMI.</p>
            </div>
            <a href="{{ route('devices.create') }}" class="btn">+ Tambah Perangkat</a>
        </div>

        @if (session('success'))
            <div class="alert success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert error">{{ session('error') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert error">
                <strong>Terjadi kesalahan:</strong>
                <ul style="margin: 8px 0 0 20px">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <section class="panel">
            <h2>Daftar Perangkat</h2>

            @if ($devices->isEmpty())
                <p class="empty">Belum ada perangkat yang terdaftar.</p>
            @else
                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Perangkat</th>
                            <th>Kode Perangkat</th>
                            <th>Lokasi</th>
                            <th>Status</th>
                            <th>Jumlah Data Sensor</th>
                            <th>Terakhir Terhubung</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($devices as $index => $device)
                            <tr>
                                <td>{{ $devices->firstItem() + $index }}</td>
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
                                        ? $device->last_seen_at->format('d-m-Y H:i:s')
                                        : 'Belum terhubung' }}
                                </td>
                                <td>
                                    <div class="actions">
                                        <a href="{{ route('devices.edit', $device) }}" class="btn btn-edit">Edit</a>

                                        <form action="{{ route('devices.destroy', $device) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus perangkat ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-delete">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="pagination">{{ $devices->links() }}</div>
            @endif
        </section>
    </main>
</body>
</html>
