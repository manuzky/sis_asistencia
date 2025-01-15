<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de asistencias</title>
    <link rel="stylesheet" href="{{ public_path('css/reportes/styles.css') }}">
</head>
<body>

    <h1>Reporte de Asistencias</h1>
    
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>Nº</th>
                    <th>Nombres y Apellidos</th>
                    <th>Cédula</th>
                    <th>Cargo</th>
                    <th>Hora de Entrada</th>
                    <th>Hora de Salida</th>
                    <th>Fecha de Asistencia</th> <!-- Nueva columna de fecha -->
                </tr>
            </thead>
            <tbody>
                <?php $contador = 1 ?>
                @foreach ($asistencias as $asistencia)
                    <tr>
                        <td>{{ $contador++ }}</td>
                        <td>{{ $asistencia->miembro->nombre_apellido }}</td>
                        <td>{{ number_format($asistencia->miembro->cedula, 0, '.', '.') }}</td>
                        <td>{{ $asistencia->miembro->cargo ? $asistencia->miembro->cargo->nombre_cargo : 'N/A' }}</td>
                        <td>{{ $asistencia->hora_entrada ? $asistencia->hora_entrada : 'N/A' }}</td>
                        <td>{{ $asistencia->hora_salida ? $asistencia->hora_salida : 'N/A' }}</td>
                        <td>{{ \Carbon\Carbon::parse($asistencia->fecha)->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>