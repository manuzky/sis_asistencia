<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Asistencias</title>
    <link rel="stylesheet" href="{{ public_path('css/reportes/styles.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .table-container {
            width: 100%;
            border-collapse: collapse;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }
        .table th, .table td {
            border: 1px solid black;
            padding: 8px;
            font-size: 14px;
        }
        .table th {
            background-color: #f2f2f2;
        }
        .firma {
            height: 40px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('images/encabezado.png') }}" alt="Encabezado" width="100%" height="10%">
    </div>
    
    <h2 style="text-align: center;">ASISTENCIA GENERAL</h2>
    
    <div class="details">
        <table style="width: 100%; text-align: center;">
            <tr>
                <td style="width: 33.3%; text-align: left;"><strong>Rango de Fechas:</strong> {{ $rango_fechas }}</td>
                <td style="width: 33.3%; text-align: center;"><strong>Turno:</strong> {{ $turno }}</td>
                <td style="width: 33.3%; text-align: right;"><strong>Fecha de Expedición:</strong> {{ $fecha }}</td>
            </tr>
        </table>
    </div>
    
    
    
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 18%;">Nombre y Apellido</th>
                    <th style="width: 10%;">Cédula</th>
                    <th style="width: 10%;">Personal</th>
                    <th style="width: 13%;">Hora de Entrada</th>
                    <th style="width: 13%;">Hora de Salida</th>
                    <th style="width: 10%;">Fecha</th> 
                    <th style="width: 10%;">Firma</th>
                    <th style="width: 18%;">Observación</th>
                </tr>
            </thead>
            
            <tbody>
                @foreach ($asistencias as $asistencia)
                    <tr>
                        <td>{{ $asistencia->miembro->nombre_apellido }}</td>
                        <td>{{ number_format($asistencia->miembro->cedula, 0, '.', '.') }}</td>
                        <td>{{ $asistencia->miembro->cargo ? $asistencia->miembro->cargo->nombre_cargo : 'N/A' }}</td>
                        <td>{{ $asistencia->hora_entrada ? \Carbon\Carbon::parse($asistencia->hora_entrada)->format('g:i A') : 'N/A' }}</td>
                        <td>{{ $asistencia->hora_salida ? \Carbon\Carbon::parse($asistencia->hora_salida)->format('g:i A') : 'N/A' }}</td>
                        <td>{{ \Carbon\Carbon::parse($asistencia->fecha)->format('d/m/Y') }}</td>
                        <td class="firma"></td>
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
