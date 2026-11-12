
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="EWS berbasis IoT untuk monitoring risiko serangan kumbang tanduk pada perkebunan kelapa sawit.">

    <title>HADATAMI | Early Warning System</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
</head>
<body>

    <!-- NAVBAR -->
    <header class="navbar">
        <div class="container nav-wrapper">
            <a href="#home" class="brand">
                <span class="brand-icon">🌿</span>
                <span class="brand-text">
                    <strong>HADATAMI</strong>
                    <small>SMART EWS · IoT</small>
                </span>
            </a>

            <nav class="nav-menu">
                <a href="#home" class="active">Beranda</a>
                <a href="#about">Tentang</a>
                <a href="#technology">Teknologi</a>
                <a href="#workflow">Alur Sistem</a>
            </nav>

            <a href="#about" class="nav-button">
                Jelajahi Sistem
                <span>↗</span>
            </a>

            <a href="{{ route('login') }}" class="btn-login">
                 Login
            </a>

            @if (Auth::check())
            <a href="{{ route('dashboard') }}" class="btn-login">
                Dashboard
            </a>

            @else
            <a href="{{ route('login') }}" class="btn-login">
                Login
            </a>
            @endif
        </div>
    </header>

    <main>
        <!-- HERO SECTION -->
        <section class="hero" id="home">
            <div class="container hero-grid">
                <div class="hero-content">
                    <span class="eyebrow">
                        <span class="status-dot"></span>
                        SMART AGRICULTURE TECHNOLOGY
                    </span>

                    <h1>
                        Hey Hadatami!,<br>
                        "Hama Datang, <span>Kita</span><br>
                        Basmiii".
                    </h1>

                    <p class="hero-description">
                        Sistem Early Warning System berbasis Internet
                        of Things untuk memantau aktivitas kumbang
                        tanduk dan kondisi iklim sebagai pendukung
                        pengambilan keputusan di perkebunan kelapa sawit.
                    </p>

                    <div class="hero-actions">
                        <a href="#about" class="button button-primary">
                            Pelajari Sistem
                            <span>→</span>
                        </a>

                        <a href="#workflow" class="button button-outline">
                            Alur Teknologi
                        </a>
                    </div>

                    <div class="hero-note">
                        <span class="note-icon">✓</span>
                        Monitoring terintegrasi berbasis data lapangan
                    </div>
                </div>

                <div class="hero-visual">
                    <img
                        src="https://i.ytimg.com/vi/XpxJupH3lB4/sddefault.jpg"
                        alt="Ilustrasi alam hijau"
                        class="hero-image"
                    >

                    <div class="image-overlay"></div>

                    <div class="hero-image-label">
                        <span class="label-indicator"></span>
                        <div>
                            <strong>SMART PLANTATION</strong>
                            <small>IoT Monitoring System</small>
                        </div>
                    </div>

                    <div class="floating-card">
                        <div class="floating-icon">⌁</div>
                        <div>
                            <strong>Early Warning System</strong>
                            <small>Monitoring & Risk Analysis</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="hero-bottom">
                <div class="container hero-bottom-inner">
                    <span>INTEGRATED MONITORING SYSTEM</span>
                    <span class="bottom-line"></span>
                    <span>INTERNET OF THINGS</span>
                    <span class="bottom-line"></span>
                    <span>OIL PALM PROTECTION</span>
                </div>
            </div>
        </section>

        <!-- ABOUT SECTION -->
        <section class="section about-section" id="about">
            <div class="container">
                <div class="section-heading">
                    <span class="section-label">TENTANG SISTEM</span>
                    <h2>
                        Teknologi untuk pemantauan
                        <span>perkebunan yang lebih terukur.</span>
                    </h2>
                    <p>
                        HADATAMI merupakan konsep sistem peringatan
                        dini berbasis IoT yang mengintegrasikan
                        pengumpulan data sensor, analisis risiko,
                        dan visualisasi informasi untuk mendukung
                        pemantauan kumbang tanduk pada kelapa sawit.
                    </p>
                </div>

                <div class="about-grid">
                    <div class="about-card about-main">
                        <div class="card-icon">⌘</div>
                        <h3>Monitoring Berbasis IoT</h3>
                        <p>
                            Data sensor dikumpulkan oleh ESP32 dan
                            dikirimkan melalui internet agar dapat
                            dikelola serta dipantau melalui platform
                            berbasis web.
                        </p>
                        <a href="#technology" class="text-link">
                            Pelajari teknologi <span>→</span>
                        </a>
                    </div>

                    <div class="about-card">
                        <div class="card-icon">◉</div>
                        <h3>Deteksi Aktivitas Hama</h3>
                        <p>
                            Menggunakan sensor IR atau optik
                            untuk menghitung kumbang yang
                            masuk ke perangkap feromon.
                        </p>
                    </div>

                    <div class="about-card">
                        <div class="card-icon">☼</div>
                        <h3>Pemantauan Kondisi Iklim</h3>
                        <p>
                            Mengamati suhu, kelembapan udara,
                            dan curah hujan sebagai parameter
                            lingkungan.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- TECHNOLOGY SECTION -->
        <section class="section technology-section" id="technology">
            <div class="container">
                <div class="section-heading centered">
                    <span class="section-label">KOMPONEN TEKNOLOGI</span>
                    <h2>
                        Sistem yang bekerja
                        <span>secara terintegrasi.</span>
                    </h2>
                    <p>
                        Setiap perangkat mempunyai fungsi yang
                        saling mendukung dalam proses pengumpulan
                        dan pengolahan data.
                    </p>
                </div>

                <div class="technology-grid">
                    <article class="technology-card">
                        <div class="tech-number">01</div>
                        <div class="tech-icon">♧</div>
                        <h3>Perangkap Feromon</h3>
                        <p>
                            Menarik kumbang tanduk ke dalam
                            perangkap sebagai bagian dari
                            pemantauan aktivitas hama.
                        </p>
                    </article>

                    <article class="technology-card">
                        <div class="tech-number">02</div>
                        <div class="tech-icon">◎</div>
                        <h3>Sensor IR / Optik</h3>
                        <p>
                            Mengidentifikasi dan menghitung
                            kumbang yang melewati area
                            pendeteksian perangkap.
                        </p>
                    </article>

                    <article class="technology-card">
                        <div class="tech-number">03</div>
                        <div class="tech-icon">☁</div>
                        <h3>Sensor Iklim</h3>
                        <p>
                            Mengukur suhu, kelembapan,
                            dan curah hujan di sekitar
                            area pengamatan.
                        </p>
                    </article>

                    <article class="technology-card">
                        <div class="tech-number">04</div>
                        <div class="tech-icon">⌘</div>
                        <h3>ESP32</h3>
                        <p>
                            Mengumpulkan data sensor,
                            melakukan pengolahan awal,
                            dan mengirim data ke server.
                        </p>
                    </article>

                    <article class="technology-card">
                        <div class="tech-number">05</div>
                        <div class="tech-icon">⇄</div>
                        <h3>Internet & Server</h3>
                        <p>
                            Menjadi jalur komunikasi dan
                            pengelolaan data antara
                            perangkat IoT dan web.
                        </p>
                    </article>

                    <article class="technology-card">
                        <div class="tech-number">06</div>
                        <div class="tech-icon">▥</div>
                        <h3>Web Dashboard</h3>
                        <p>
                            Menyajikan data monitoring,
                            analisis risiko, dan informasi
                            peringatan dini.
                        </p>
                    </article>
                </div>
            </div>
        </section>

        <!-- WORKFLOW SECTION -->
        <section class="section workflow-section" id="workflow">
            <div class="container">
                <div class="section-heading">
                    <span class="section-label">ALUR KERJA SISTEM</span>
                    <h2>
                        Dari pengamatan lapangan
                        <span>menjadi informasi.</span>
                    </h2>
                    <p>
                        Proses kerja EWS dimulai dari pengumpulan
                        data sensor hingga menampilkan hasil
                        analisis dan peringatan pada platform web.
                    </p>
                </div>

                <div class="workflow-list">
                    <div class="workflow-item">
                        <div class="workflow-step">01</div>
                        <div class="workflow-content">
                            <h3>Pengumpulan Data</h3>
                            <p>
                                Sensor mendeteksi jumlah kumbang,
                                suhu, kelembapan, dan curah hujan
                                di area perkebunan.
                            </p>
                        </div>
                    </div>

                    <div class="workflow-item">
                        <div class="workflow-step">02</div>
                        <div class="workflow-content">
                            <h3>Pengolahan oleh ESP32</h3>
                            <p>
                                ESP32 membaca data, melakukan
                                validasi awal, dan menyiapkan
                                data untuk dikirim.
                            </p>
                        </div>
                    </div>

                    <div class="workflow-item">
                        <div class="workflow-step">03</div>
                        <div class="workflow-content">
                            <h3>Pengiriman dan Penyimpanan</h3>
                            <p>
                                Data dikirim melalui internet
                                ke server Laravel untuk
                                divalidasi dan disimpan
                                ke database.
                            </p>
                        </div>
                    </div>

                    <div class="workflow-item">
                        <div class="workflow-step">04</div>
                        <div class="workflow-content">
                            <h3>Analisis Risiko</h3>
                            <p>
                                Sistem mengolah data aktivitas
                                kumbang dan parameter iklim
                                berdasarkan aturan analisis
                                yang ditentukan.
                            </p>
                        </div>
                    </div>

                    <div class="workflow-item">
                        <div class="workflow-step">05</div>
                        <div class="workflow-content">
                            <h3>Dashboard dan Peringatan</h3>
                            <p>
                                Hasil pengamatan dan analisis
                                disajikan melalui dashboard,
                                disertai peringatan apabila
                                memenuhi kondisi yang ditetapkan.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FOOTER -->
        <footer class="footer">
            <div class="container footer-content">
                <a href="#home" class="brand footer-brand">
                    <span class="brand-icon">🌿</span>
                    <span class="brand-text">
                        <strong>HADATAMI</strong>
                        <small>SMART EWS · IoT</small>
                    </span>
                </a>

                <p>
                    Teknologi monitoring dan peringatan dini
                    untuk mendukung perkebunan kelapa sawit.
                </p>

                <div class="footer-bottom">
                    <span>© {{ date('Y') }} HADATAMI EWS</span>
                    <a href="#home">Kembali ke atas ↑</a>
                </div>
            </div>
        </footer>
    </main>

</body>
</html>

