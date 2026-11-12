<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Login | HADATAMI</title>

    <style>

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #eef4f0;
        }

        .container {
            width: 100%;
            max-width: 420px;
            padding: 20px;
        }

        .card {
            background: white;
            padding: 35px;
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        }

        .logo {
            text-align: center;
            margin-bottom: 25px;
        }

        .logo-icon {
            font-size: 42px;
            margin-bottom: 8px;
        }

        .logo h1 {
            color: #123b2a;
            font-size: 27px;
        }

        .logo p {
            color: #6b7280;
            font-size: 13px;
            margin-top: 6px;
        }

        .title {
            color: #183d2c;
            font-size: 20px;
            margin-bottom: 5px;
        }

        .description {
            color: #6b7280;
            font-size: 13px;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 17px;
        }

        label {
            display: block;
            color: #374151;
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 7px;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #d1d5db;
            border-radius: 7px;
            outline: none;
            font-size: 14px;
        }

        input:focus {
            border-color: #17613d;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 7px;
            margin-bottom: 20px;
            font-size: 12px;
            color: #6b7280;
        }

        .remember input {
            accent-color: #17613d;
        }

        .btn {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 7px;
            background: #17613d;
            color: white;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn:hover {
            background: #124c30;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
            padding: 11px;
            border-radius: 7px;
            font-size: 12px;
            margin-bottom: 15px;
        }

        .success {
            background: #dcfce7;
            color: #166534;
            padding: 11px;
            border-radius: 7px;
            font-size: 12px;
            margin-bottom: 15px;
        }

        .footer {
            text-align: center;
            color: #9ca3af;
            font-size: 11px;
            margin-top: 20px;
            line-height: 1.6;
        }

    </style>

</head>

<body>

<div class="container">

    <div class="card">

        <div class="logo">

            <div class="logo-icon">
                🌴
            </div>

            <h1>
                HADATAMI
            </h1>

            <p>
                Early Warning System Kelapa Sawit
            </p>

        </div>

        <h2 class="title">
            Login
        </h2>

        <p class="description">
            Silakan masuk untuk mengakses sistem monitoring PALMGUARD.
        </p>

        @if (session('success'))

            <div class="success">
                {{ session('success') }}
            </div>

        @endif

        @if ($errors->any())

            <div class="error">

                @foreach ($errors->all() as $error)

                    <div>
                        {{ $error }}
                    </div>

                @endforeach

            </div>

        @endif

        <form
            method="POST"
            action="{{ route('login') }}"
        >

            @csrf

            <div class="form-group">

                <label for="email">
                    Email
                </label>

                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Masukkan email"
                    required
                    autofocus
                >

            </div>

            <div class="form-group">

                <label for="password">
                    Password
                </label>

                <input
                    id="password"
                    type="password"
                    name="password"
                    placeholder="Masukkan password"
                    required
                >

            </div>

            <label class="remember">

                <input
                    type="checkbox"
                    name="remember"
                    value="1"
                >

                Ingat saya

            </label>

            <button
                type="submit"
                class="btn"
            >
                Masuk ke HADATAMI
            </button>

        </form>

        <div class="footer">

            Sistem Monitoring dan Early Warning System
            <br>
            Tanaman Kelapa Sawit Berbasis IoT

        </div>

    </div>

</div>

</body>

</html>
