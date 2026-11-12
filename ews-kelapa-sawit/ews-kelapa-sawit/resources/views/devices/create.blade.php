<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Perangkat | HADATAMI</title>
    <style>
        * { box-sizing: border-box; font-family: Arial, sans-serif; }
        body { margin: 0; padding: 30px; background: #f3f6f4; color: #1f2937; }
        .container { max-width: 650px; margin: 30px auto; background: white; padding: 28px; border-radius: 12px; box-shadow: 0 3px 14px #00000008; }
        h1 { color: #183d2c; font-size: 23px; margin: 0 0 8px; }
        p { color: #6b7280; font-size: 13px; margin-bottom: 24px; }
        label { display: block; font-size: 13px; font-weight: bold; margin: 16px 0 7px; }
        input, textarea { width: 100%; padding: 11px; border: 1px solid #d1d5db; border-radius: 7px; font-size: 14px; }
        textarea { resize: vertical; min-height: 85px; }
        .error { color: #b91c1c; font-size: 12px; margin-top: 5px; }
        .actions { display: flex; gap: 10px; margin-top: 23px; }
        .btn { padding: 11px 15px; border: 0; border-radius: 6px; background: #17613d; color: white; text-decoration: none; cursor: pointer; font-size: 13px; }
        .cancel { background: #e5e7eb; color: #374151; }
    </style>
</head>
<body>
    <main class="container">
        <h1>Tambah Perangkat IoT</h1>
        <p>Masukkan identitas perangkat ESP32 yang akan didaftarkan.</p>

        <form action="{{ route('devices.store') }}" method="POST">
            @csrf

            <label for="device_code">Kode Perangkat</label>
            <input id="device_code" name="device_code" type="text"
                value="{{ old('device_code') }}" placeholder="Contoh: PG-ESP32-002" required>
            @error('device_code')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="device_name">Nama Perangkat</label>
            <input id="device_name" name="device_name" type="text"
                value="{{ old('device_name') }}" placeholder="Contoh: ESP32 Blok A" required>
            @error('device_name')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="location">Lokasi Pemasangan</label>
            <textarea id="location" name="location"
                placeholder="Contoh: Blok A, dekat jalan utama">{{ old('location') }}</textarea>
            @error('location')
                <div class="error">{{ $message }}</div>
            @enderror

            <div class="actions">
                <button type="submit" class="btn">Simpan Perangkat</button>
                <a href="{{ route('devices.index') }}" class="btn cancel">Batal</a>
            </div>
        </form>
    </main>
</body>
</html>
