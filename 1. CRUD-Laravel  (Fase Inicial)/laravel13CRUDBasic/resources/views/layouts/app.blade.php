<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        @hasSection('title')
            @yield('title') | Students CRUD
        @else
            Students CRUD
        @endif
    </title>

    {{-- Bootstrap 5 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    {{-- Google Fonts: Inter --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-primary: #0f1117;
            --bg-secondary: #1a1d27;
            --bg-card: #1e2130;
            --accent-blue: #4f8ef7;
            --accent-cyan: #22d3ee;
            --accent-green: #10b981;
            --accent-red: #ef4444;
            --accent-yellow: #f59e0b;
            --accent-purple: #8b5cf6;
            --text-primary: #e2e8f0;
            --text-muted: #64748b;
            --border-color: #2d3348;
        }

        * { box-sizing: border-box; }

        body {
            background-color: var(--bg-primary);
            color: var(--text-primary);
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
        }

        /* Navbar */
        .app-navbar {
            background: var(--bg-secondary);
            border-bottom: 1px solid var(--border-color);
            padding: 0.75rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .app-navbar .brand-icon {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, var(--accent-blue), var(--accent-purple));
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1rem; color: #fff;
        }
        .app-navbar .brand-name {
            font-size: 1.1rem; font-weight: 700;
            background: linear-gradient(90deg, var(--accent-blue), var(--accent-cyan));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .app-navbar .brand-sub {
            font-size: 0.7rem; color: var(--text-muted); font-weight: 400;
            display: block; margin-top: -4px;
        }

        /* Main content */
        .app-main { padding: 2rem 1.5rem; max-width: 1100px; margin: 0 auto; }

        /* Page header */
        .page-header {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;
        }
        .page-title {
            font-size: 1.5rem; font-weight: 700; color: var(--text-primary);
            display: flex; align-items: center; gap: 0.5rem;
        }
        .page-title i { color: var(--accent-blue); }

        /* Cards */
        .app-card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 14px;
            overflow: hidden;
        }

        /* Table */
        .app-table { margin: 0; }
        .app-table thead th {
            background: rgba(79,142,247,0.08);
            color: var(--text-muted);
            font-size: 0.72rem; font-weight: 600;
            text-transform: uppercase; letter-spacing: 0.08em;
            border-bottom: 1px solid var(--border-color);
            border-top: none; padding: 0.85rem 1.25rem;
        }
        .app-table tbody tr {
            border-bottom: 1px solid var(--border-color);
            transition: background 0.15s;
        }
        .app-table tbody tr:last-child { border-bottom: none; }
        .app-table tbody tr:hover { background: rgba(79,142,247,0.04); }
        .app-table td {
            color: var(--text-primary);
            vertical-align: middle;
            padding: 0.9rem 1.25rem;
            background: transparent;
            border: none;
        }
        .app-table .id-badge {
            background: rgba(79,142,247,0.12);
            color: var(--accent-blue);
            border-radius: 6px; padding: 2px 8px;
            font-size: 0.78rem; font-weight: 600;
        }

        /* Action buttons */
        .btn-action {
            width: 32px; height: 32px;
            border-radius: 8px; border: 1px solid;
            display: inline-flex; align-items: center; justify-content: center;
            font-size: 0.85rem; transition: all 0.2s; cursor: pointer;
            padding: 0; text-decoration: none;
        }
        .btn-view  { color: var(--accent-cyan);   border-color: rgba(34,211,238,0.3);  background: rgba(34,211,238,0.07);  }
        .btn-edit  { color: var(--accent-yellow);  border-color: rgba(245,158,11,0.3);  background: rgba(245,158,11,0.07);  }
        .btn-delete{ color: var(--accent-red);    border-color: rgba(239,68,68,0.3);   background: rgba(239,68,68,0.07);   }
        .btn-view:hover   { background: rgba(34,211,238,0.18);  color: var(--accent-cyan);  }
        .btn-edit:hover   { background: rgba(245,158,11,0.18);  color: var(--accent-yellow); }
        .btn-delete:hover { background: rgba(239,68,68,0.18);   color: var(--accent-red);  }

        /* Primary button */
        .btn-primary-custom {
            background: linear-gradient(135deg, var(--accent-blue), var(--accent-purple));
            border: none; color: #fff; border-radius: 10px;
            padding: 0.5rem 1.1rem; font-size: 0.9rem; font-weight: 500;
            display: inline-flex; align-items: center; gap: 0.4rem;
            transition: opacity 0.2s; cursor: pointer; text-decoration: none;
        }
        .btn-primary-custom:hover { opacity: 0.88; color: #fff; }

        .btn-secondary-custom {
            background: transparent; border: 1px solid var(--border-color);
            color: var(--text-muted); border-radius: 10px;
            padding: 0.5rem 1.1rem; font-size: 0.9rem; font-weight: 500;
            display: inline-flex; align-items: center; gap: 0.4rem;
            transition: all 0.2s; cursor: pointer; text-decoration: none;
        }
        .btn-secondary-custom:hover { border-color: var(--accent-blue); color: var(--accent-blue); }

        /* Modals */
        .modal-content {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 16px; color: var(--text-primary);
        }
        .modal-header {
            border-bottom: 1px solid var(--border-color);
            padding: 1.25rem 1.5rem;
        }
        .modal-title { font-weight: 600; font-size: 1.05rem; }
        .modal-body { padding: 1.5rem; }
        .modal-footer { border-top: 1px solid var(--border-color); padding: 1rem 1.5rem; }
        .btn-close-custom {
            background: transparent; border: none;
            color: var(--text-muted); font-size: 1.1rem; cursor: pointer;
            transition: color 0.2s; padding: 0.25rem;
        }
        .btn-close-custom:hover { color: var(--text-primary); }

        /* Form controls */
        .form-label { font-size: 0.82rem; font-weight: 500; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.04em; margin-bottom: 0.4rem; }
        .form-control, .form-select {
            background: var(--bg-secondary);
            border: 1px solid var(--border-color);
            border-radius: 10px; color: var(--text-primary);
            padding: 0.6rem 0.9rem; font-size: 0.9rem;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .form-control:focus, .form-select:focus {
            background: var(--bg-secondary);
            border-color: var(--accent-blue);
            box-shadow: 0 0 0 3px rgba(79,142,247,0.15);
            color: var(--text-primary);
        }
        .form-control::placeholder { color: var(--text-muted); }
        .form-control.is-invalid { border-color: var(--accent-red); }
        .invalid-feedback { font-size: 0.8rem; color: var(--accent-red); }

        /* Alert */
        .alert-success-custom {
            background: rgba(16,185,129,0.1); border: 1px solid rgba(16,185,129,0.3);
            border-radius: 10px; padding: 0.8rem 1rem; color: var(--accent-green);
            display: flex; align-items: center; gap: 0.6rem; font-size: 0.9rem;
        }

        /* Detail rows (show modal) */
        .detail-row {
            display: flex; align-items: flex-start; gap: 0.75rem;
            padding: 0.85rem 0; border-bottom: 1px solid var(--border-color);
        }
        .detail-row:last-child { border-bottom: none; }
        .detail-icon {
            width: 34px; height: 34px; border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.9rem; flex-shrink: 0;
        }
        .detail-label { font-size: 0.75rem; color: var(--text-muted); margin-bottom: 2px; }
        .detail-value { font-size: 0.95rem; font-weight: 500; color: var(--text-primary); }

        /* Pagination */
        .pagination .page-link {
            background: var(--bg-secondary); border: 1px solid var(--border-color);
            color: var(--text-muted); border-radius: 8px !important; margin: 0 2px;
        }
        .pagination .page-link:hover { background: var(--bg-card); color: var(--accent-blue); border-color: var(--accent-blue); }
        .pagination .page-item.active .page-link { background: var(--accent-blue); border-color: var(--accent-blue); color: #fff; }

        /* Empty state */
        .empty-state { text-align: center; padding: 3rem 1rem; color: var(--text-muted); }
        .empty-state i { font-size: 3rem; margin-bottom: 1rem; display: block; }

        /* Tooltip */
        [data-bs-toggle="tooltip"] { cursor: pointer; }

        @media (max-width: 640px) {
            .app-main { padding: 1rem; }
            .app-table td, .app-table th { padding: 0.7rem 0.75rem; }
        }
    </style>
</head>
<body>

    {{-- Navbar --}}
    <nav class="app-navbar">
        <div class="brand-icon"><i class="bi bi-mortarboard-fill"></i></div>
        <div>
            <span class="brand-name">StudentHub</span>
            <span class="brand-sub">Sistema de Gestão</span>
        </div>
    </nav>

    <main class="app-main">
        @yield('content')
    </main>

    {{-- Bootstrap 5 JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Init tooltips globally
        document.addEventListener('DOMContentLoaded', function () {
            const tooltips = document.querySelectorAll('[data-bs-toggle="tooltip"]');
            tooltips.forEach(el => new bootstrap.Tooltip(el, { trigger: 'hover' }));
        });
    </script>

    @yield('scripts')
</body>
</html>
