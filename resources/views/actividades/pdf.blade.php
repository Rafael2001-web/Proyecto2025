<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Actividades</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #111827; }
        h1 { font-size: 18px; margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #e5e7eb; padding: 6px; text-align: left; vertical-align: top; }
        th { background: #f3f4f6; }
        .muted { color: #6b7280; }
    </style>
</head>
<body>
    <h1>Reporte de Actividades</h1>
    <table>
        <thead>
            <tr>
                <th>Proyecto</th>
                <th>Codigo</th>
                <th>Nombre</th>
                <th>Responsable</th>
                <th>Estado</th>
                <th>Avance Real</th>
                <th>Estado Reportado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($actividades as $actividad)
                <tr>
                    <td>{{ $actividad->proyecto->nombre ?? 'Sin proyecto' }}</td>
                    <td>{{ $actividad->codigo }}</td>
                    <td>{{ $actividad->nombre }}</td>
                    <td>{{ $actividad->responsable ?? 'No asignado' }}</td>
                    <td>{{ $actividad->estado }}</td>
                    <td>{{ $actividad->avance_real !== null ? number_format($actividad->avance_real, 2) . '%' : 'N/A' }}</td>
                    <td>{{ $actividad->estado_reportado }}</td>
                </tr>
                <tr>
                    <td colspan="7" class="muted">
                        Objetivos: {{ $actividad->objetivosEstrategicos->pluck('descripcion')->implode(' | ') ?: 'Sin objetivos' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>