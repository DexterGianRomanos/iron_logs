<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'IronLog') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- PWA -->
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#FF4D00">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="IronLog">
    <link rel="apple-touch-icon" href="/icons/icon-192x192.png">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --primary: #FF4D00;
            --primary-light: #FF7A33;
            --primary-faint: #FFF0EB;
            --navy: #1A1A2E;
            --bg: #F5F6FA;
            --surface: #FFFFFF;
            --border: #E8EAF0;
            --text: #1A1A2E;
            --text-muted: #8890A4;
            --success: #22C55E;
            --danger: #EF4444;
            --shadow: 0 4px 24px rgba(26,26,46,0.08);
            --shadow-lg: 0 8px 40px rgba(26,26,46,0.12);
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            padding-bottom: 80px;
        }

        /* ── PWA Install Banner ── */
        #pwa-install-banner {
            display: none;
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 9999;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            padding: 12px 16px;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            box-shadow: 0 4px 20px rgba(255,77,0,0.4);
            animation: slideDown 0.4s ease;
        }
        @keyframes slideDown {
            from { transform: translateY(-100%); opacity: 0; }
            to   { transform: translateY(0);    opacity: 1; }
        }
        .pwa-banner-left {
            display: flex; align-items: center; gap: 10px; flex: 1;
        }
        .pwa-banner-icon {
            width: 36px; height: 36px; background: rgba(255,255,255,0.2);
            border-radius: 8px; display: flex; align-items: center; justify-content: center;
            font-size: 18px; flex-shrink: 0;
        }
        .pwa-banner-text { font-size: 13px; font-weight: 500; line-height: 1.3; }
        .pwa-banner-text strong { display: block; font-size: 14px; font-weight: 700; }
        #install-btn {
            background: white;
            color: var(--primary);
            border: none;
            padding: 9px 18px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 13px;
            cursor: pointer;
            white-space: nowrap;
            font-family: 'DM Sans', sans-serif;
            transition: transform 0.15s, box-shadow 0.15s;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        }
        #install-btn:hover { transform: scale(1.05); box-shadow: 0 4px 12px rgba(0,0,0,0.2); }
        #dismiss-banner {
            background: transparent; border: none; color: rgba(255,255,255,0.8);
            font-size: 20px; cursor: pointer; padding: 4px; line-height: 1; flex-shrink: 0;
        }

        /* ── Top Nav ── */
        .top-nav {
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            padding: 0 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 60px;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 12px rgba(26,26,46,0.06);
        }
        .nav-logo {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 26px;
            letter-spacing: 2px;
            color: var(--navy);
            text-decoration: none;
        }
        .nav-logo span { color: var(--primary); }

        /* ── Bottom Nav ── */
        .bottom-nav {
            position: fixed;
            bottom: 0; left: 0; right: 0;
            background: var(--surface);
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: space-around;
            padding: 8px 0 20px;
            z-index: 100;
            box-shadow: 0 -4px 24px rgba(26,26,46,0.08);
        }
        .nav-item {
            display: flex; flex-direction: column; align-items: center; gap: 3px;
            text-decoration: none; color: var(--text-muted);
            font-size: 11px; font-weight: 600; padding: 6px 16px;
            border-radius: 12px; transition: all 0.2s; flex: 1;
        }
        .nav-item.active { color: var(--primary); }
        .nav-item svg { width: 22px; height: 22px; }
        .nav-item:hover { color: var(--primary); background: var(--primary-faint); }

        /* ── Page wrapper ── */
        .page-wrap { max-width: 640px; margin: 0 auto; padding: 20px 16px; }

        /* ── Cards ── */
        .card {
            background: var(--surface);
            border-radius: 16px;
            padding: 20px;
            box-shadow: var(--shadow);
            margin-bottom: 14px;
            border: 1px solid var(--border);
        }

        /* ── Workout Cards ── */
        .workout-card {
            background: var(--surface);
            border-radius: 16px;
            padding: 20px;
            box-shadow: var(--shadow);
            margin-bottom: 14px;
            border: 1px solid var(--border);
            border-left: 4px solid var(--primary);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .workout-card:hover { transform: translateY(-2px); box-shadow: var(--shadow-lg); }

        .workout-header {
            display: flex; justify-content: space-between; align-items: flex-start;
            margin-bottom: 14px;
        }
        .workout-type {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 22px; letter-spacing: 1px; color: var(--navy);
        }
        .workout-date {
            font-size: 12px; color: var(--text-muted); font-weight: 600;
            background: var(--bg); padding: 4px 10px; border-radius: 20px;
        }

        /* ── Type Badges ── */
        .type-badge {
            display: inline-block;
            padding: 3px 10px; border-radius: 20px;
            font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;
        }
        .badge-push  { background: #FFF0EB; color: var(--primary); }
        .badge-pull  { background: #EBF4FF; color: #2563EB; }
        .badge-legs  { background: #F0FFF4; color: #16A34A; }
        .badge-full  { background: #F5F0FF; color: #7C3AED; }
        .badge-cardio{ background: #FFF9EB; color: #D97706; }

        /* ── Exercise pills ── */
        .exercise-pill {
            display: flex; justify-content: space-between; align-items: center;
            background: var(--bg); border-radius: 10px;
            padding: 10px 14px; margin-bottom: 8px;
        }
        .exercise-pill-name { font-weight: 600; font-size: 14px; }
        .exercise-pill-stats { font-size: 13px; color: var(--primary); font-weight: 700; }

        /* ── Buttons ── */
        .btn-primary {
            background: var(--primary); color: white; border: none;
            padding: 13px 24px; border-radius: 50px;
            font-weight: 700; font-size: 15px; cursor: pointer;
            font-family: 'DM Sans', sans-serif;
            transition: background 0.2s, transform 0.15s;
            text-decoration: none; display: inline-block; text-align: center;
        }
        .btn-primary:hover { background: var(--primary-light); transform: translateY(-1px); }
        .btn-primary.full { width: 100%; }

        .btn-secondary {
            background: var(--bg); color: var(--text); border: 1px solid var(--border);
            padding: 10px 18px; border-radius: 50px;
            font-weight: 600; font-size: 13px; cursor: pointer;
            font-family: 'DM Sans', sans-serif; text-decoration: none; display: inline-block;
            transition: background 0.2s;
        }
        .btn-secondary:hover { background: var(--border); }

        .btn-danger {
            background: transparent; color: var(--danger); border: 1px solid var(--danger);
            padding: 8px 14px; border-radius: 50px; font-weight: 600; font-size: 12px;
            cursor: pointer; font-family: 'DM Sans', sans-serif; transition: all 0.2s;
        }
        .btn-danger:hover { background: var(--danger); color: white; }

        .btn-ghost-blue {
            background: #EBF4FF; color: #2563EB; border: none;
            padding: 8px 14px; border-radius: 50px; font-weight: 600; font-size: 12px;
            cursor: pointer; font-family: 'DM Sans', sans-serif; text-decoration: none;
            display: inline-block; transition: background 0.2s;
        }
        .btn-ghost-blue:hover { background: #DBEAFE; }

        /* ── FAB ── */
        .fab {
            position: fixed; bottom: 80px; right: 20px;
            width: 56px; height: 56px; border-radius: 50%;
            background: var(--primary); color: white; border: none;
            font-size: 26px; cursor: pointer; box-shadow: 0 6px 24px rgba(255,77,0,0.4);
            display: flex; align-items: center; justify-content: center;
            text-decoration: none; transition: transform 0.2s, box-shadow 0.2s;
            z-index: 50;
        }
        .fab:hover { transform: scale(1.1); box-shadow: 0 8px 32px rgba(255,77,0,0.5); }

        /* ── Forms ── */
        .form-group { margin-bottom: 18px; }
        .form-label {
            display: block; font-weight: 600; margin-bottom: 6px;
            font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-muted);
        }
        .form-control {
            width: 100%; padding: 12px 14px;
            background: var(--bg); border: 1.5px solid var(--border); color: var(--text);
            border-radius: 12px; font-family: 'DM Sans', sans-serif; font-size: 15px;
            transition: border-color 0.2s;
        }
        .form-control:focus { outline: none; border-color: var(--primary); background: white; }
        .form-control.is-invalid { border-color: var(--danger); }
        .field-error { color: var(--danger); font-size: 12px; margin-top: 4px; font-weight: 600; }

        .grid-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 10px; }

        /* ── Alerts ── */
        .alert-success {
            background: #F0FFF4; border: 1px solid #BBF7D0; color: #16A34A;
            padding: 12px 16px; border-radius: 12px; margin-bottom: 16px;
            font-weight: 600; font-size: 14px;
        }
        .alert-error {
            background: #FFF5F5; border: 1px solid #FECACA; color: var(--danger);
            padding: 14px 16px; border-radius: 12px; margin-bottom: 16px; font-size: 13px;
        }
        .alert-error strong { display: block; font-size: 13px; margin-bottom: 6px; text-transform: uppercase; }
        .alert-error ul { padding-left: 18px; }
        .alert-error ul li { margin-bottom: 3px; }

        /* ── Page heading ── */
        .page-heading {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 32px; letter-spacing: 2px; color: var(--navy);
            margin-bottom: 4px;
        }
        .page-sub { color: var(--text-muted); font-size: 14px; margin-bottom: 20px; }

        /* ── Empty state ── */
        .empty-state {
            text-align: center; padding: 60px 20px; color: var(--text-muted);
        }
        .empty-state-icon { font-size: 52px; margin-bottom: 14px; }
        .empty-state h3 { font-size: 18px; font-weight: 700; color: var(--navy); margin-bottom: 6px; }
        .empty-state p { font-size: 14px; margin-bottom: 20px; }

        /* ── Card actions row ── */
        .card-actions { display: flex; gap: 8px; flex-wrap: wrap; margin-top: 14px; align-items: center; }

        /* ── Back link ── */
        .back-link {
            display: inline-flex; align-items: center; gap: 6px;
            color: var(--text-muted); text-decoration: none; font-size: 13px; font-weight: 600;
            margin-bottom: 16px; transition: color 0.2s;
        }
        .back-link:hover { color: var(--primary); }

        /* ── Section divider ── */
        .section-label {
            font-size: 11px; font-weight: 700; text-transform: uppercase;
            letter-spacing: 1px; color: var(--text-muted); margin: 20px 0 10px;
        }

        /* ── Stat chips ── */
        .stat-row { display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 14px; }
        .stat-chip {
            background: var(--primary-faint); color: var(--primary);
            padding: 5px 12px; border-radius: 20px;
            font-size: 12px; font-weight: 700;
        }
    </style>
</head>
<body>
    <!-- PWA Install Banner -->
    <div id="pwa-install-banner">
        <div class="pwa-banner-left">
            <div class="pwa-banner-icon">🏋️</div>
            <div class="pwa-banner-text">
                <strong>Add IronLog to Home Screen</strong>
                Install the app for quick access
            </div>
        </div>
        <button id="install-btn">📲 Install App</button>
        <button id="dismiss-banner">✕</button>
    </div>

    <!-- Top Nav -->
    <nav class="top-nav">
        <a href="{{ route('workouts.index') }}" class="nav-logo">Iron<span>Log</span></a>
    </nav>

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>

    <!-- Bottom Nav -->
    <nav class="bottom-nav">
        <a href="{{ route('workouts.index') }}" class="nav-item {{ request()->routeIs('workouts.index') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
                <rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/>
            </svg>
            Sessions
        </a>
        <a href="{{ route('workouts.create') }}" class="nav-item {{ request()->routeIs('workouts.create') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/>
            </svg>
            New
        </a>
        <a href="{{ route('workouts.index') }}#stats" class="nav-item">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/>
            </svg>
            Stats
        </a>
    </nav>

    <!-- PWA Scripts -->
    <script>
        let deferredPrompt;

        window.addEventListener('beforeinstallprompt', (e) => {
            e.preventDefault();
            deferredPrompt = e;
            document.getElementById('pwa-install-banner').style.display = 'flex';
        });

        document.getElementById('install-btn').addEventListener('click', async () => {
            if (!deferredPrompt) return;
            deferredPrompt.prompt();
            const { outcome } = await deferredPrompt.userChoice;
            console.log('PWA install:', outcome);
            deferredPrompt = null;
            document.getElementById('pwa-install-banner').style.display = 'none';
        });

        document.getElementById('dismiss-banner').addEventListener('click', () => {
            document.getElementById('pwa-install-banner').style.display = 'none';
        });

        window.addEventListener('appinstalled', () => {
            document.getElementById('pwa-install-banner').style.display = 'none';
        });

        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/sw.js')
                .then(reg => console.log('IronLog SW registered:', reg.scope))
                .catch(err => console.error('SW error:', err));
        }
    </script>
</body>
</html>
