<svg {{ $attributes->merge(['class' => 'fill-current']) }} xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200">
    <!-- Círculo base con gradiente sutil -->
    <defs>
        <linearGradient id="logoGradient" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" style="stop-color:currentColor;stop-opacity:0.15" />
            <stop offset="100%" style="stop-color:currentColor;stop-opacity:0.05" />
        </linearGradient>
    </defs>
    <circle cx="100" cy="100" r="90" fill="url(#logoGradient)"/>
    
    <!-- Diseño del logo SIPeIP -->
    <g stroke="currentColor" stroke-width="2.5" fill="none">
        <!-- Documento principal con sombra -->
        <rect x="60" y="50" width="80" height="100" rx="6" ry="6" fill="currentColor" opacity="0.03"/>
        <rect x="60" y="50" width="80" height="100" rx="6" ry="6"/>
        
        <!-- Líneas del documento -->
        <line x1="75" y1="70" x2="125" y2="70" stroke-width="2"/>
        <line x1="75" y1="85" x2="125" y2="85" stroke-width="2"/>
        <line x1="75" y1="100" x2="125" y2="100" stroke-width="2"/>
        <line x1="75" y1="115" x2="105" y2="115" stroke-width="2"/>
        
        <!-- Icono de planificación (gráfico mejorado) -->
        <polyline points="75,120 85,110 95,125 105,115 115,130" stroke-width="2.5"/>
        <circle cx="85" cy="110" r="2.5" fill="currentColor"/>
        <circle cx="95" cy="125" r="2.5" fill="currentColor"/>
        <circle cx="105" cy="115" r="2.5" fill="currentColor"/>
        <circle cx="115" cy="130" r="2.5" fill="currentColor"/>
    </g>
    
    <!-- Texto SIPeIP mejorado -->
    <text x="100" y="175" text-anchor="middle" font-family="Arial, sans-serif" font-size="16" font-weight="bold" fill="currentColor" opacity="0.9">
        SIPeIP
    </text>
    <text x="100" y="190" text-anchor="middle" font-family="Arial, sans-serif" font-size="8" fill="currentColor" opacity="0.7">
        Sistema de Planificación
    </text>
</svg>