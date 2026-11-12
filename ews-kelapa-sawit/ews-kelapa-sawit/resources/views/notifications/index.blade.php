<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Notifikasi | HADATAMI</title>

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

        .btn-read {
            background: #2563eb;
        }

        .btn-reset {
            background: #6b7280;
        }

        .alert {
            padding: 12px 14px;
            border-radius: 7px;
            margin-bottom: 15px;
            font-size: 13px;
        }

        .success {
            background: #dcfce7;
            color: #166534;
        }

        .notification {
            border-left: 5px solid #d1d5db;
            background: #f9fafb;
            padding: 16px;
            margin-bottom: 12px;
            border-radius: 7px;
        }

        .notification.warning {
            border-left-color: #d97706;
        }

        .notification.critical {
            border-left-color: #dc2626;
        }

        .notification.unread {
            background: #fff;
            box-shadow: 0 2px 8px #00000008;
        }

        .notification-header {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            align-items: center;
        }

        .notification-title {
            font-weight: bold;
            font-size: 14px;
            color: #183d2c;
        }

        .severity {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .severity.warning {
            background: #fef3c7;
            color: #92400e;
        }

        .severity.critical {
            background: #fee2e2;
            color: #991b1b;
        }

        .notification-message {
            color: #4b5563;
            font-size: 13px;
            line-height: 1.6;
            margin-top: 9px;
        }

        .notification-info {
            color: #9ca3af;
            font-size: 11px;
            margin-top: 10px;
        }

        .notification-actions {
            margin-top: 12px;
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

            .notification-header {
                align-items: flex-start;
                flex-direction: column;
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

            <a href="{{ route('analysis.index') }}">
                ⌁ Analisis Risiko
            </a>

            <a href="{{ route('notifications.index') }}"
               class="active">
                ♧ Notifikasi
            </a>

        </nav>

    </aside>

    <main class="main">

        <h1>Notifikasi</h1>

        <p class="subtitle">
            Peringatan dan informasi kondisi risiko dari perangkat HADATAMI.
        </p>

        @if (session('success'))

            <div class="alert success">
                {{ session('success') }}
            </div>

        @endif

        <section class="summary">

            <div class="card">

                <div class="card-label">
                    Total Notifikasi
                </div>

                <div class="card-value">
                    {{ $totalNotifications }}
                </div>

            </div>

            <div class="card">

                <div class="card-label">
                    Belum Dibaca
                </div>

                <div class="card-value">
                    {{ $unreadNotifications }}
                </div>

            </div>

            <div class="card">

                <div class="card-label">
                    Peringatan
                </div>

                <div class="card-value">
                    {{ $warningNotifications }}
                </div>

            </div>

            <div class="card">

                <div class="card-label">
                    Kritis
                </div>

                <div class="card-value">
                    {{ $criticalNotifications }}
                </div>

            </div>

        </section>

        <section class="panel">

            <h2>Filter Notifikasi</h2>

            <form method="GET"
                  action="{{ route('notifications.index') }}"
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
                    href="{{ route('notifications.index') }}"
                    class="btn btn-reset"
                >
                    Reset
                </a>

                @if ($unreadNotifications > 0)

                    <form
                        action="{{ route('notifications.read-all') }}"
                        method="POST"
                    >
                        @csrf
                        @method('PATCH')

                        <button
                            type="submit"
                            class="btn btn-read"
                        >
                            Tandai Semua Dibaca
                        </button>
                    </form>

                @endif

            </form>

            @if ($notifications->isEmpty())

                <p class="empty">
                    Belum ada notifikasi.
                </p>

            @else

                @foreach ($notifications as $notification)

                    <div class="
                        notification
                        {{ strtolower($notification->severity ?? '') }}
                        {{ $notification->read_at ? '' : 'unread' }}
                    ">

                        <div class="notification-header">

                            <div class="notification-title">
                                {{ $notification->title }}
                            </div>

                            <span class="
                                severity
                                {{ strtolower($notification->severity ?? '') }}
                            ">
                                {{ $notification->severity ?? 'informasi' }}
                            </span>

                        </div>

                        <div class="notification-message">
                            {{ $notification->message }}
                        </div>

                        <div class="notification-info">

                            Perangkat:
                            <strong>
                                {{ $notification->device?->device_name ?? '—' }}
                            </strong>

                            &nbsp; | &nbsp;

                            Waktu:
                            {{ $notification->created_at
                                ? $notification->created_at->format('d-m-Y H:i:s')
                                : '—' }}

                            &nbsp; | &nbsp;

                            Status:
                            {{ $notification->read_at
                                ? 'Sudah dibaca'
                                : 'Belum dibaca' }}

                        </div>

                        @if (!$notification->read_at)

                            <div class="notification-actions">

                                <form
                                    action="{{ route('notifications.read', $notification) }}"
                                    method="POST"
                                >

                                    @csrf

                                    @method('PATCH')

                                    <button
                                        type="submit"
                                        class="btn btn-read"
                                    >
                                        Tandai Sudah Dibaca
                                    </button>

                                </form>

                            </div>

                        @endif

                    </div>

                @endforeach

                <div class="pagination">
                    {{ $notifications->links() }}
                </div>

            @endif

        </section>

    </main>

</body>

</html>
