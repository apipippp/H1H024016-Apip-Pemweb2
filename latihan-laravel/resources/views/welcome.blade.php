<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Praktikum Pemrograman Web II - Modul 1</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-gradient: radial-gradient(circle at 50% 0%, #1e1b4b 0%, #0f172a 50%, #020617 100%);
            --card-bg: rgba(30, 41, 59, 0.7);
            --card-border: rgba(255, 255, 255, 0.1);
            --accent-red: #ef4444;
            --accent-blue: #38bdf8;
            --accent-emerald: #10b981;
            --text-primary: #f8fafc;
            --text-secondary: #94a3b8;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background: var(--bg-gradient);
            color: var(--text-primary);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
            position: relative;
            overflow-x: hidden;
        }

        /* Ambient glow */
        .glow {
            position: absolute;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(239, 68, 68, 0.15) 0%, rgba(56, 189, 248, 0.1) 40%, transparent 70%);
            top: -150px;
            left: 50%;
            transform: translateX(-50%);
            pointer-events: none;
            z-index: 0;
            filter: blur(50px);
        }

        .container {
            max-width: 860px;
            width: 100%;
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(239, 68, 68, 0.12);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fca5a5;
            padding: 0.4rem 1rem;
            border-radius: 9999px;
            font-size: 0.85rem;
            font-weight: 600;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            margin-bottom: 0.5rem;
        }

        .hero-badge .dot {
            width: 8px;
            height: 8px;
            background: var(--accent-red);
            border-radius: 50%;
            box-shadow: 0 0 10px var(--accent-red);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.4; }
        }

        .card {
            background: var(--card-bg);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid var(--card-border);
            border-radius: 1.25rem;
            padding: 2.25rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            transition: transform 0.2s ease, border-color 0.2s ease;
        }

        .card:hover {
            border-color: rgba(255, 255, 255, 0.2);
        }

        .header-title {
            font-size: 2.25rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, #ffffff 0%, #cbd5e1 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .header-subtitle {
            color: var(--text-secondary);
            font-size: 1.05rem;
            margin-bottom: 1.5rem;
        }

        /* Identity box */
        .identity-box {
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(56, 189, 248, 0.2);
            border-radius: 1rem;
            padding: 1.5rem;
            margin-top: 1rem;
        }

        .identity-title {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--accent-blue);
            font-weight: 700;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .identity-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1.25rem;
        }

        .identity-item {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .identity-label {
            font-size: 0.8rem;
            color: var(--text-secondary);
        }

        .identity-value {
            font-size: 1.15rem;
            font-weight: 700;
            color: #ffffff;
            letter-spacing: -0.01em;
        }

        .identity-value.mono {
            font-family: 'JetBrains Mono', monospace;
            color: var(--accent-blue);
        }

        /* System info grid */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }

        .info-card {
            background: rgba(15, 23, 42, 0.4);
            border: 1px solid var(--card-border);
            border-radius: 0.75rem;
            padding: 1rem 1.25rem;
            display: flex;
            flex-direction: column;
            gap: 0.35rem;
        }

        .info-card-label {
            font-size: 0.75rem;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .info-card-value {
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--text-primary);
            font-family: 'JetBrains Mono', monospace;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .badge-status {
            display: inline-block;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: var(--accent-emerald);
            box-shadow: 0 0 8px var(--accent-emerald);
        }

        .footer-text {
            text-align: center;
            color: var(--text-secondary);
            font-size: 0.85rem;
        }

        .footer-text a {
            color: #cbd5e1;
            text-decoration: none;
            transition: color 0.2s;
        }

        .footer-text a:hover {
            color: var(--accent-red);
        }
    </style>
</head>
<body>
    <div class="glow"></div>
    
    <div class="container">
        <main class="card">
            <div class="hero-badge">
                <span class="dot"></span>
                Praktikum Pemrograman Web II &bull; Modul 1
            </div>
            
            <h1 class="header-title">Penyiapan Lingkungan Pengembangan Web Modern</h1>
            <p class="header-subtitle">
                Eksplorasi Framework Web Modern: Full-stack MVC dengan Laravel 13 (PHP) & High-Performance REST API dengan Fiber v3 (Go).
            </p>

            <!-- TUGAS 2: IDENTITAS MAHASISWA -->
            <div class="identity-box">
                <div class="identity-title">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Identitas Praktikan
                </div>
                <div class="identity-grid">
                    <div class="identity-item">
                        <span class="identity-label">Nama Mahasiswa</span>
                        <span class="identity-value">Afif Nur Rahman</span>
                    </div>
                    <div class="identity-item">
                        <span class="identity-label">Nomor Induk Mahasiswa (NIM)</span>
                        <span class="identity-value mono">H1H024016</span>
                    </div>
                    <div class="identity-item">
                        <span class="identity-label">Program Studi</span>
                        <span class="identity-value">Teknik Komputer</span>
                    </div>
                    <div class="identity-item">
                        <span class="identity-label">Perguruan Tinggi</span>
                        <span class="identity-value">Universitas Jenderal Soedirman</span>
                    </div>
                </div>
            </div>

            <!-- SYSTEM / ENVIRONMENT STATUS -->
            <div class="info-grid">
                <div class="info-card">
                    <span class="info-card-label">Framework Version</span>
                    <span class="info-card-value">
                        Laravel v{{ Illuminate\Foundation\Application::VERSION }}
                    </span>
                </div>
                <div class="info-card">
                    <span class="info-card-label">PHP Environment</span>
                    <span class="info-card-value">
                        PHP v{{ PHP_VERSION }}
                    </span>
                </div>
                <div class="info-card">
                    <span class="info-card-label">Server Status</span>
                    <span class="info-card-value">
                        <span class="badge-status"></span> Active (Port 8000)
                    </span>
                </div>
                <div class="info-card">
                    <span class="info-card-label">Tahun Akademik</span>
                    <span class="info-card-value">
                        2026 / 2027
                    </span>
                </div>
            </div>
        </main>

        <footer class="footer-text">
            Praktikum Pemrograman Web II &bull; Laboratorium Teknik Komputer &bull; Fakultas Teknik UNSOED
        </footer>
    </div>
</body>
</html>
