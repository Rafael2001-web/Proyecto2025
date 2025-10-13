<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Sistema Integrado de Planificación e Inversión Pública - SIPeIP 2.0 @yield('title')</title>
        
        <!-- Favicon -->
        <link rel="icon" type="image/svg+xml" href="data:image/svg+xml;base64,{{ base64_encode('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><circle cx="100" cy="100" r="90" fill="#002216" opacity="0.1"/><g stroke="#00feb8" stroke-width="3" fill="none"><rect x="60" y="50" width="80" height="100" rx="5" ry="5"/><line x1="75" y1="70" x2="125" y2="70"/><line x1="75" y1="85" x2="125" y2="85"/><line x1="75" y1="100" x2="125" y2="100"/><line x1="75" y1="115" x2="105" y2="115"/><polyline points="75,120 85,110 95,125 105,115 115,130"/><circle cx="85" cy="110" r="2" fill="#00feb8"/><circle cx="95" cy="125" r="2" fill="#00feb8"/><circle cx="105" cy="115" r="2" fill="#00feb8"/><circle cx="115" cy="130" r="2" fill="#00feb8"/></g><text x="100" y="175" text-anchor="middle" font-family="Arial, sans-serif" font-size="14" font-weight="bold" fill="#002216">SIPeIP</text></svg>') }}">
        <link rel="apple-touch-icon" href="data:image/svg+xml;base64,{{ base64_encode('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><circle cx="100" cy="100" r="90" fill="#002216" opacity="0.1"/><g stroke="#00feb8" stroke-width="3" fill="none"><rect x="60" y="50" width="80" height="100" rx="5" ry="5"/><line x1="75" y1="70" x2="125" y2="70"/><line x1="75" y1="85" x2="125" y2="85"/><line x1="75" y1="100" x2="125" y2="100"/><line x1="75" y1="115" x2="105" y2="115"/><polyline points="75,120 85,110 95,125 105,115 115,130"/><circle cx="85" cy="110" r="2" fill="#00feb8"/><circle cx="95" cy="125" r="2" fill="#00feb8"/><circle cx="105" cy="115" r="2" fill="#00feb8"/><circle cx="115" cy="130" r="2" fill="#00feb8"/></g><text x="100" y="175" text-anchor="middle" font-family="Arial, sans-serif" font-size="14" font-weight="bold" fill="#002216">SIPeIP</text></svg>') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/table.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        {{-- Page Heading --}}
        @if (isset($header))
            <header class="bg-primary shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        {{-- Contenido principal --}}
        <main>
            {{ $slot }}
        </main>
    </div>

    <footer class="bg-gray-200 p-4 text-center">
        <small>&copy; {{ date('Y') }} SIPeIP 2.0</small>
    </footer>
</body>
</html>