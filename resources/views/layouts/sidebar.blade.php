<aside class="fixed left-0 top-0 h-screen bg-gray-900 text-white shadow-xl z-40 overflow-y-auto transition-all duration-300 ease-in-out"
       x-data="{
           openMenus: {},
           get collapsed() { return $store.sidebar?.collapsed ?? false },
           toggleCollapse() { $store.sidebar.collapsed = !$store.sidebar.collapsed }
       }"
       x-init="if (!$store.sidebar) { Alpine.store('sidebar', { collapsed: false }) }"
       x-bind:class="{ 'w-20': collapsed, 'w-64': !collapsed }">

    <!-- Logo / Brand -->
    <div class="flex items-center justify-center h-24 bg-gray-800 border-b border-gray-700 py-4">
        <a href="{{ route('dashboard') }}" class="flex items-center space-x-3">
            <x-application-logo class="fill-current text-accent transition-all duration-300" x-bind:class="{ 'h-10 w-10': collapsed, 'h-14 w-14': !collapsed }" />
            <span x-show="!collapsed" x-transition class="text-2xl font-bold text-accent">SIPeIP 2.0</span>
        </a>
    </div>

    <!-- Toggle Button -->
    <button @click="toggleCollapse()"
            class="absolute top-6 -right-3 bg-accent text-gray-900 rounded-full p-1.5 shadow-lg hover:bg-accent/90 transition-all duration-200 z-50">
        <svg x-show="!collapsed" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        <svg x-show="collapsed" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
    </button>

    <!-- Navigation Menu -->
    <nav class="mt-4" x-bind:class="{ 'px-2': collapsed, 'px-3': !collapsed }">
        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}"
           class="flex items-center mb-1 rounded-lg transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-accent text-gray-900 font-semibold' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}"
           x-bind:class="{ 'justify-center px-2 py-3': collapsed, 'px-4 py-3': !collapsed }"
           x-bind:title="collapsed ? 'Dashboard' : ''">
            <svg class="w-5 h-5" x-bind:class="{ 'mr-3': !collapsed }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2 2v0z" />
            </svg>
            <span x-show="!collapsed" x-transition>Dashboard</span>
        </a>

        <!-- Estructura Organizacional -->
        @canany(['view entidades', 'manage entidades', 'view unidades', 'manage unidades'])
            <div class="mb-1">
                <button @click="collapsed ? null : (openMenus['estructura'] = !openMenus['estructura'])"
                        class="flex items-center w-full rounded-lg transition-all duration-200 {{ request()->routeIs(['entidades.*', 'unidades.*']) ? 'bg-gray-800 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}"
                        x-bind:class="{ 'justify-center px-2 py-3': collapsed, 'justify-between px-4 py-3': !collapsed }"
                        x-bind:title="collapsed ? 'Estructura' : ''">
                    <div class="flex items-center">
                        <svg class="w-5 h-5" x-bind:class="{ 'mr-3': !collapsed }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        <span x-show="!collapsed" x-transition>Estructura</span>
                    </div>
                    <svg x-show="!collapsed" class="w-4 h-4 transition-transform duration-200"
                         x-bind:class="{ 'rotate-180': openMenus['estructura'] }"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div x-show="!collapsed && openMenus['estructura']"
                     x-collapse
                     class="ml-8 mt-1 space-y-1">
                    @canany(['view entidades', 'manage entidades'])
                        <a href="{{ route('entidades.index') }}"
                           class="flex items-center px-4 py-2 rounded-lg text-sm transition-all duration-200 {{ request()->routeIs('entidades.*') ? 'bg-accent text-gray-900 font-semibold' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M10.5 3L12 2l1.5 1H21l-1 6H4l-1-6h7.5z" />
                            </svg>
                            Entidades
                        </a>
                    @endcanany

                    @canany(['view unidades', 'manage unidades'])
                        <a href="{{ route('unidades.index') }}"
                           class="flex items-center px-4 py-2 rounded-lg text-sm transition-all duration-200 {{ request()->routeIs('unidades.*') ? 'bg-accent text-gray-900 font-semibold' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            Unidades
                        </a>
                    @endcanany
                </div>
            </div>
        @endcanany

        <!-- Planificación -->
        @canany(['view planes', 'manage planes', 'view pnd', 'manage pnd', 'view objetivos_estrategicos', 'manage objetivos_estrategicos', 'view ods', 'manage ods', 'view strategic alignement', 'manage strategic alignement'])
            <div class="mb-1">
                <button @click="collapsed ? null : (openMenus['planificacion'] = !openMenus['planificacion'])"
                        class="flex items-center w-full rounded-lg transition-all duration-200 {{ request()->routeIs(['planes.*', 'pnd.*', 'objEstrategicos.*', 'ods.*']) ? 'bg-gray-800 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}"
                        x-bind:class="{ 'justify-center px-2 py-3': collapsed, 'justify-between px-4 py-3': !collapsed }"
                        x-bind:title="collapsed ? 'Planificación' : ''">
                    <div class="flex items-center">
                        <svg class="w-5 h-5" x-bind:class="{ 'mr-3': !collapsed }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                        <span x-show="!collapsed" x-transition>Planificación</span>
                    </div>
                    <svg x-show="!collapsed" class="w-4 h-4 transition-transform duration-200"
                         x-bind:class="{ 'rotate-180': openMenus['planificacion'] }"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div x-show="!collapsed && openMenus['planificacion']"
                     x-collapse
                     class="ml-8 mt-1 space-y-1">
                    @canany(['view planes', 'manage planes'])
                        <a href="{{ route('planes.index') }}"
                           class="flex items-center px-4 py-2 rounded-lg text-sm transition-all duration-200 {{ request()->routeIs('planes.*') ? 'bg-accent text-gray-900 font-semibold' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Planes
                        </a>
                    @endcanany

                    @canany(['view pnd', 'manage pnd'])
                        <a href="{{ route('pnd.index') }}"
                           class="flex items-center px-4 py-2 rounded-lg text-sm transition-all duration-200 {{ request()->routeIs('pnd.*') ? 'bg-accent text-gray-900 font-semibold' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                            </svg>
                            PND
                        </a>
                    @endcanany

                    @canany(['view objetivos_estrategicos', 'manage objetivos_estrategicos'])
                        <a href="{{ route('objEstrategicos.index') }}"
                           class="flex items-center px-4 py-2 rounded-lg text-sm transition-all duration-200 {{ request()->routeIs('objEstrategicos.*') ? 'bg-accent text-gray-900 font-semibold' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            Obj. Estratégicos
                        </a>
                    @endcanany

                    @canany(['view ods', 'manage ods'])
                        <a href="{{ route('ods.index') }}"
                           class="flex items-center px-4 py-2 rounded-lg text-sm transition-all duration-200 {{ request()->routeIs('ods.*') ? 'bg-accent text-gray-900 font-semibold' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            ODS
                        </a>
                    @endcanany
                    {{-- @dd(auth()->user()->can('view strategic alignement'), auth()->user()->can('manage strategic alignement')) --}}
                    @canany(['view strategic alignment', 'manage strategic alignment'])
                        <a href="{{ route('objetivos-institucionales.index') }}"
                           class="flex items-center px-4 py-2 rounded-lg text-sm transition-all duration-200 {{ request()->routeIs('objetivos-institucionales.*') ? 'bg-accent text-gray-900 font-semibold' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Objetivos Institucionales
                        </a>
                    @endcanany
                </div>
            </div>
        @endcanany

        <!-- Ejecución -->
        @canany(['view proyectos', 'manage proyectos', 'view programas', 'manage programas'])
            <div class="mb-1">
                <button @click="collapsed ? null : (openMenus['ejecucion'] = !openMenus['ejecucion'])"
                        class="flex items-center w-full rounded-lg transition-all duration-200 {{ request()->routeIs(['proyectos.*', 'programas.*']) ? 'bg-gray-800 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}"
                        x-bind:class="{ 'justify-center px-2 py-3': collapsed, 'justify-between px-4 py-3': !collapsed }"
                        x-bind:title="collapsed ? 'Ejecución' : ''">
                    <div class="flex items-center">
                        <svg class="w-5 h-5" x-bind:class="{ 'mr-3': !collapsed }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        <span x-show="!collapsed" x-transition>Ejecución</span>
                    </div>
                    <svg x-show="!collapsed" class="w-4 h-4 transition-transform duration-200"
                         x-bind:class="{ 'rotate-180': openMenus['ejecucion'] }"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div x-show="!collapsed && openMenus['ejecucion']"
                     x-collapse
                     class="ml-8 mt-1 space-y-1">
                    @canany(['view proyectos', 'manage proyectos'])
                        <a href="{{ route('proyectos.index') }}"
                           class="flex items-center px-4 py-2 rounded-lg text-sm transition-all duration-200 {{ request()->routeIs('proyectos.*') ? 'bg-accent text-gray-900 font-semibold' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            Proyectos
                        </a>
                    @endcanany

                    @canany(['view programas', 'manage programas'])
                        <a href="{{ route('programas.index') }}"
                           class="flex items-center px-4 py-2 rounded-lg text-sm transition-all duration-200 {{ request()->routeIs('programas.*') ? 'bg-accent text-gray-900 font-semibold' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            Programas
                        </a>
                    @endcanany
                </div>
            </div>
        @endcanany

        <!-- Administración -->
        @can('manage usuarios')
            <div class="mb-1">
                <button @click="collapsed ? null : (openMenus['admin'] = !openMenus['admin'])"
                        class="flex items-center w-full rounded-lg transition-all duration-200 {{ request()->routeIs(['usuarios.*', 'roles.*', 'permissions.*']) ? 'bg-gray-800 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}"
                        x-bind:class="{ 'justify-center px-2 py-3': collapsed, 'justify-between px-4 py-3': !collapsed }"
                        x-bind:title="collapsed ? 'Administración' : ''">
                    <div class="flex items-center">
                        <svg class="w-5 h-5" x-bind:class="{ 'mr-3': !collapsed }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span x-show="!collapsed" x-transition>Administración</span>
                    </div>
                    <svg x-show="!collapsed" class="w-4 h-4 transition-transform duration-200"
                         x-bind:class="{ 'rotate-180': openMenus['admin'] }"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div x-show="!collapsed && openMenus['admin']"
                     x-collapse
                     class="ml-8 mt-1 space-y-1">
                    <a href="{{ route('usuarios.index') }}"
                       class="flex items-center px-4 py-2 rounded-lg text-sm transition-all duration-200 {{ request()->routeIs('usuarios.*') ? 'bg-accent text-gray-900 font-semibold' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                        </svg>
                        Usuarios
                    </a>

                    <a href="{{ route('roles.index') }}"
                       class="flex items-center px-4 py-2 rounded-lg text-sm transition-all duration-200 {{ request()->routeIs('roles.*') ? 'bg-accent text-gray-900 font-semibold' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Roles
                    </a>

                    <a href="{{ route('permissions.index') }}"
                       class="flex items-center px-4 py-2 rounded-lg text-sm transition-all duration-200 {{ request()->routeIs('permissions.*') ? 'bg-accent text-gray-900 font-semibold' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        Permisos
                    </a>
                </div>
            </div>
        @endcan
    </nav>

    <!-- User Info at Bottom -->
    <div class="absolute bottom-0 w-full border-t border-gray-700 bg-gray-800" x-bind:class="{ 'p-2': collapsed, 'p-4': !collapsed }">
        <div class="flex items-center" x-bind:class="{ 'justify-center': collapsed, 'space-x-3': !collapsed }">
            <div class="rounded-full bg-accent flex items-center justify-center text-gray-900 font-bold"
                 x-bind:class="{ 'w-10 h-10 text-sm': collapsed, 'w-10 h-10': !collapsed }">
                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
            </div>
            <div x-show="!collapsed" x-transition class="flex-1 min-w-0">
                <p class="text-sm font-medium text-white truncate">{{ Auth::user()->name }}</p>
                {{-- Roles del usuario --}}
                <p class="text-xs text-gray-400 truncate">{{ implode(', ', Auth::user()->roles->pluck('name')->toArray()) }}</p>
                <p class="text-xs text-gray-400 truncate">{{ Auth::user()->email }}</p>
            </div>
        </div>
    </div>
</aside>
