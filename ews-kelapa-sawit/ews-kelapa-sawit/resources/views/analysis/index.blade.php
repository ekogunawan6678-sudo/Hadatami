<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Analisis Risiko | HADATAMI</title>

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
            width: 235px;
            height: 100vh;
            background: #123b2a;
            color: white;
            padding: 25px 18px;
        }

        .brand {
            font-size: 23px;
            font-weight: bold;
            margin: 5px 10px 35px;
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
        }

        .main {
            margin-left: 235px;
            padding: 30px;
        }

        h1 {
            color: #183d2c;
            font-size: 25px;
        }

        h2 {
            color: #183d2c;
            font-size: 17px;
            margin-bottom: 18px;
        }

        .subtitle {
            color: #6b7280;
            font-size: 13px;
            margin-top: 7px;
        }

        .summary {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            margin: 25px 0;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 3px 14px #00000008;
        }

        .card-label {
            color: #6b7280;
            font-size: 13px;
            margin-bottom: 10px;
        }

        .card-value {
            color: #174b32;
            font-size: 27px;
            font-weight: bold;
        }

        .panel {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 3px 14px #00000008;
            overflow-x: auto;
        }

        .filter {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        select {
            padding: 10px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            background: white;
        }

        .btn {
            padding: 10px 14px;
            border: none;
            border-radius: 6px;
            background: #17613d;
            color: white;
            cursor: pointer;
            text-decoration: none;
            font-size: 13px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 800px;
        }

        th,
        td {
            padding: 13px 11px;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
            font-size: 12px;
        }

        th {
            background: #f8faf9;
            color: #4b5563;
        }

        .status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .rendah {
            background: #dcfce7;
            color: #166534;
        }

        .sedang {
            background: #fef3c7;
            color: #92400e;
        }

        .tinggi {
            background: #fee2e2;
            color: #991b1b;
        }

        .empty {
            color: #6b7280;
            font-size: 13px;
            padding: 15px 0;
        }

        .pagination {
            margin-top: 18px;
        }

        .pagination a,
        .pagination span {
            display: inline-block;
            padding: 6px 10px;
            margin: 2px;
            border: 1px solid #e5e7eb;
            border-radius: 5px;
            text-decoration: none;
            color: #17613d;
        }

        @media(max-width: 900px) {
            .summary {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media(max-width: 760px) {
            .sidebar {
                position: static;
                width: 100%;
                height: auto;
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

            .summary {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <aside class="sidebar">

        <div class="brand">
            🌴 HADATAMI
        </div>

        <div class="menu-title">
            Menu Utama
        </div>

        <nav class="menu">

            <a href="{{ route('dashboard') }}">
                ▦ Dashboard
            </a>

            <a href="{{ route('monitoring.index') }}">
                ◉ Monitoring
            </a>

            <a href="{{ route('devices.index') }}">
                ▣ Perangkat IoT
            </a>

            <a href="{{ route('analysis.index') }}" class="active">
                ⌁ Analisis Risiko
            </a>

            <a href="{{ route('notifications.index') }}">
                ♧ Notifikasi
            </a>

        </nav>

    </aside>

    <main class="main">

        <h1>Analisis Risiko</h1>

        <p class="subtitle">
            Riwayat hasil analisis risiko berdasarkan data monitoring perangkat IoT.
        </p>

        <section class="summary">

            <div class="card">
                <div class="card-label">
                    Total Analisis
                </div>

                <div class="card-value">
                    {{ $totalRisk }}
                </div>
            </div>

            <div class="card">
                <div class="card-label">
                    Risiko Rendah
                </div>

                <div class="card-value">
                    {{ $lowRisk }}
                </div>
            </div>

            <div class="card">
                <div class="card-label">
                    Risiko Sedang
                </div>

                <div class="card-value">
                    {{ $mediumRisk }}
                </div>
            </div>

            <div class="card">
                <div class="card-label">
                    Risiko Tinggi
                </div>

                <div class="card-value">
                    {{ $highRisk }}
                </div>
            </div>

        </section>

        <section class="panel">

            <h2>Filter Perangkat</h2>

            <form method="GET"
                  action="{{ route('analysis.index') }}"
                  class="filter">

                <select name="device_id">

                    <option value="">
                        Semua Perangkat
                    </option>

                    @foreach ($devices as $device)

                        <option
                            value="{{ $device->id }}"
                            {{ $deviceId == $device->id ? 'selected' : '' }}
                        >
                            {{ $device->device_name }}
                        </option>

                    @endforeach

                </select>

                <button type="submit" class="btn">
                    Filter
                </button>

                <a
                    href="{{ route('analysis.index') }}"
                    class="btn"
                >
                    Reset
                </a>

            </form>

            @if ($riskAnalyses->isEmpty())

                <p class="empty">
                    Belum terdapat data analisis risiko.
                </p>

            @else

                <table>

                    <thead>

                        <tr>
                            <th>No.</th>
                            <th>Perangkat</th>
                            <th>Jumlah Kumbang</th>
                            <th>Tingkat Risiko</th>
                            <th>Analisis</th>
                            <th>Waktu Analisis</th>
                        </tr>

                    </thead>

                    <tbody>

                        @foreach ($riskAnalyses as $index => $risk)

                            <tr>

                                <td>
                                    {{ $riskAnalyses->firstItem() + $index }}
                                </td>

                                <td>
                                    {{ $risk->device?->device_name ?? '—' }}
                                </td>

                                <td>
                                    {{ $risk->sensorReading?->beetle_count ?? '—' }}
                                    ekor
                                </td>

                                <td>

                                    <span
                                        class="status {{ strtolower($risk->risk_level) }}"
                                    >
                                        {{ $risk->risk_level }}
                                    </span>

                                </td>

                                <td>
                                    {{ $risk->analysis }}
                                </td>

                                <td>
                                    {{ $risk->analyzed_at
                                        ? $risk->analyzed_at->format('d-m-Y H:i:s')
                                        : '—' }}
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

                <div class="pagination">
                    {{ $riskAnalyses->links() }}
                </div>

            @endif

        </section>

    </main>

</body>

</html>
