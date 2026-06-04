<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        @hasSection('title')
            @yield('title') | StudentHub
        @else
            StudentHub
        @endif
    </title>

    {{-- Bootstrap 5 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@600;700&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:        #f4f1ec;
            --surface:   #ffffff;
            --border:    #e2ddd5;
            --border-lt: #f0ece5;
            --ink:       #1e1b17;
            --ink-muted: #6b6560;
            --ink-faint: #a09890;
            --blue:      #4a6fa5;
            --blue-bg:   #eef3fb;
            --blue-bdr:  #c5d5ec;
            --red:       #b94040;
            --red-bg:    #fdf0f0;
            --red-bdr:   #e8c5c5;
            --green:     #3d7a5c;
            --green-bg:  #eef7f2;
        }

        html, body {
            height: 100%;
            background: var(--bg);
            color: var(--ink);
            font-family: 'DM Sans', sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        /* ── Navbar ────────────────────────────────────────── */
        .app-nav {
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            padding: 0 2rem;
            height: 58px;
            display: flex;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            text-decoration: none;
        }

        .nav-brand-icon {
            width: 34px;
            height: 34px;
            background: var(--ink);
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .nav-brand-icon svg {
            width: 17px;
            height: 17px;
            color: var(--bg);
        }

        .nav-brand-text {
            display: flex;
            flex-direction: column;
            line-height: 1;
        }
        .nav-brand-name {
            font-family: 'Lora', Georgia, serif;
            font-size: 1rem;
            font-weight: 700;
            color: var(--ink);
            letter-spacing: -0.01em;
        }
        .nav-brand-sub {
            font-size: 0.68rem;
            color: var(--ink-faint);
            font-weight: 500;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            margin-top: 2px;
        }

        /* subtle divider after brand */
        .nav-divider {
            width: 1px;
            height: 22px;
            background: var(--border);
            margin: 0 1.25rem;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 0.15rem;
            list-style: none;
        }
        .nav-links a {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.35rem 0.7rem;
            border-radius: 7px;
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--ink-muted);
            text-decoration: none;
            transition: background 0.12s, color 0.12s;
        }
        .nav-links a svg { width: 14px; height: 14px; }
        .nav-links a:hover {
            background: var(--border-lt);
            color: var(--ink);
        }
        .nav-links a.active {
            background: #ece9e3;
            color: var(--ink);
            font-weight: 600;
        }

        /* ── Main content ──────────────────────────────────── */
        .app-main {
            max-width: 1100px;
            margin: 0 auto;
            padding: 2.5rem 1.5rem;
        }

        @media (max-width: 640px) {
            .app-nav { padding: 0 1rem; }
            .app-main { padding: 1.5rem 1rem; }
            .nav-divider, .nav-links { display: none; }
        }
    </style>
</head>
<body>

    <nav class="app-nav">
        <a href="/" class="nav-brand">
            <div class="nav-brand-icon">
                {{-- mortarboard --}}
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
                    <path d="M6 12v5c0 1.657 2.686 3 6 3s6-1.343 6-3v-5"/>
                </svg>
            </div>
            <div class="nav-brand-text">
                <span class="nav-brand-name">StudentHub</span>
                <span class="nav-brand-sub">Sistema de Gestão</span>
            </div>
        </a>

        <div class="nav-divider"></div>

        <ul class="nav-links">
            <li>
                <a href="{{ route('students.index') }}"
                   class="{{ request()->routeIs('students.*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                    Estudantes
                </a>
            </li>
            <li>
                <a href="{{ route('turmas.index') }}"
                   class="{{ request()->routeIs('turmas.*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/>
                        <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
                    </svg>
                    Turmas
                </a>
            </li>
        </ul>
    </nav>

    <main class="app-main">
        @yield('content')
    </main>

    {{-- Bootstrap 5 JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tooltips = document.querySelectorAll('[data-bs-toggle="tooltip"]');
            tooltips.forEach(el => new bootstrap.Tooltip(el, { trigger: 'hover' }));
        });
    </script>

    @yield('scripts')
</body>
</html>
