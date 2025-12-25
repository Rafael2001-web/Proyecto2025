<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Página No Encontrada - Sistema Integrado de Planificación e Inversión Pública - SIPeIP 2.0</title>
        
        <!-- Favicon -->
        <link rel="icon" type="image/svg+xml" href="data:image/svg+xml;base64,{{ base64_encode('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><circle cx="100" cy="100" r="90" fill="#002216" opacity="0.1"/><g stroke="#00feb8" stroke-width="3" fill="none"><rect x="60" y="50" width="80" height="100" rx="5" ry="5"/><line x1="75" y1="70" x2="125" y2="70"/><line x1="75" y1="85" x2="125" y2="85"/><line x1="75" y1="100" x2="125" y2="100"/><line x1="75" y1="115" x2="105" y2="115"/><polyline points="75,120 85,110 95,125 105,115 115,130"/><circle cx="85" cy="110" r="2" fill="#00feb8"/><circle cx="95" cy="125" r="2" fill="#00feb8"/><circle cx="105" cy="115" r="2" fill="#00feb8"/><circle cx="115" cy="130" r="2" fill="#00feb8"/></g><text x="100" y="175" text-anchor="middle" font-family="Arial, sans-serif" font-size="14" font-weight="bold" fill="#002216">SIPeIP</text></svg>') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 flex items-center justify-center">
            <div class="max-w-md w-full mx-auto">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-8 text-center">
                        <!-- Icono de Página No Encontrada -->
                        <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-blue-100 mb-6">
                            <svg class="h-10 w-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>

                        <!-- Código de Error -->
                        <div class="mb-4">
                            <h1 class="text-6xl font-bold text-primary mb-2">404</h1>
                            <h2 class="text-2xl font-semibold text-neutral mb-4">Página No Encontrada</h2>
                        </div>

                        <!-- Mensaje -->
                        <div class="mb-8">
                            <p class="text-neutral/70 text-lg mb-4">
                                La página que estás buscando no existe o ha sido movida.
                            </p>
                            <p class="text-neutral/60 text-sm">
                                Verifica la URL o navega a través del menú principal.
                            </p>
                        </div>

                        <!-- Información del Sistema -->
                        <div class="bg-light/30 rounded-lg p-4 mb-6">
                            <div class="flex items-center justify-center mb-2">
                                <svg class="w-6 h-6 text-secondary mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span class="text-sm font-medium text-neutral">Sistema SIPeIP 2.0</span>
                            </div>
                            <p class="text-xs text-neutral/60">Sistema Integrado de Planificación e Inversión Pública</p>
                        </div>

                        <!-- Botones de Acción -->
                        <div class="space-y-3">
                            @auth
                                <a href="{{ route('dashboard') }}" 
                                   class="w-full inline-flex items-center justify-center px-4 py-2 bg-secondary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-accent active:bg-secondary focus:outline-none focus:border-secondary focus:ring ring-secondary/20 disabled:opacity-25 transition ease-in-out duration-150">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                    </svg>
                                    Ir al Dashboard
                                </a>
                                
                                <button onclick="history.back()" 
                                        class="w-full inline-flex items-center justify-center px-4 py-2 bg-neutral border border-neutral/20 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-neutral/80 active:bg-neutral focus:outline-none focus:border-neutral focus:ring ring-neutral/20 disabled:opacity-25 transition ease-in-out duration-150">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M15 19l-7-7 7-7"/>
                                    </svg>
                                    Volver Atrás
                                </button>
                            @else
                                <a href="{{ route('login') }}" 
                                   class="w-full inline-flex items-center justify-center px-4 py-2 bg-secondary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-accent active:bg-secondary focus:outline-none focus:border-secondary focus:ring ring-secondary/20 disabled:opacity-25 transition ease-in-out duration-150">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                                    </svg>
                                    Iniciar Sesión
                                </a>
                            @endauth
                        </div>

                        <!-- Información adicional -->
                        <div class="mt-8 pt-6 border-t border-gray-200">
                            <p class="text-xs text-neutral/50">
                                Código de Error: 404 - Página No Encontrada
                            </p>
                            <p class="text-xs text-neutral/50 mt-1">
                                Fecha: {{ now()->format('d/m/Y H:i:s') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>