<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reporte por Cargo</title>
</head>
<body>
    <h1>Reporte de Asistencias - Cargo: {{ $cargo }}</h1>
    <table border="1" cellspacing="0" cellpadding="5">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($asistencias as $asistencia)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $asistencia->nombre }}</td>
                    <td>{{ $asistencia->fecha }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
