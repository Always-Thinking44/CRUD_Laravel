<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Painel Escolar')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@600;700&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="margin:0; background:#f4f1ec;">

    <nav style="background:#1e1b17; padding:0.75rem 1.5rem; display:flex; align-items:center; justify-content:space-between; font-family:'DM Sans', sans-serif;">
        <a href="{{ route('students.index') }}" style="color:#f4f1ec; font-weight:600; text-decoration:none; font-family:'Lora', serif; font-size:1.1rem;">
            Painel Escolar
        </a>

        @auth
        <div style="display:flex; align-items:center; gap:1rem;">
            <span style="color:#c9c3ba; font-size:0.875rem;">
                Olá, {{ Auth::user()->name }}
            </span>

            <a href="{{ route('profile.edit') }}" style="color:#c9c3ba; font-size:0.85rem; text-decoration:none;">
                Perfil
            </a>

            <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                @csrf
                <button type="submit" style="background:transparent; border:1px solid #6b6560; color:#f4f1ec; padding:0.4rem 0.9rem; border-radius:8px; font-size:0.85rem; cursor:pointer;">
                    Sair
                </button>
            </form>
        </div>
        @endauth
    </nav>

    <main>
        @yield('content')
    </main>

    @yield('scripts')
</body>
</html>
