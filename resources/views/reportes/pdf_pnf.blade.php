<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de asistencias</title>
    <!-- Estilos en línea para mejor compatibilidad con PDF -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .table-container {
            width: 100%;
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
        }
        td {
            word-wrap: break-word;
        }
    </style>
</head>
<body>

    <h1>Reporte de Asistencias</h1>
    
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>Nº</th>
                    <th>Nombre y Apellido</th>
                    <th>Cédula</th>
                    <th>Materia Asignada</th>
                    <th>Hora de Entrada</th>
                    <th>Hora de Salida</th>
                    <th>Fecha de Asistencia</th>
                </tr>
            </thead>
            <tbody>
                <?php $contador = 1 ?>
                @foreach ($asistencias as $asistencia)
                    <tr>
                        <td>{{ $contador++ }}</td>
                        <td>{{ $asistencia->miembro->nombre_apellido }}</td>
                        <td>{{ number_format($asistencia->miembro->cedula, 0, '.', '.') }}</td>
                        <td>
                            {{ $asistencia->horario->materia->nombre ?? 'N/A' }}  <!-- Materia asignada -->
                        </td>
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
