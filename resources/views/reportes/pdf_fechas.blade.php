<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de asistencias</title>
</head>
<body>
    <br><br>
    <h1>Reporte de asistencias</h1>
    <table id="example1" class="table table-bordered table-striped" border="3">
        <thead class="thead">
            <tr>
                <th>Nº</th>
                <th>ID</th>
                <th>Nombres y Apellidos</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            <?php $contador = 1 ?>
            @foreach ($asistencias as $asistencia)
                <tr>
                    <td>{{ $contador++ }}</td>
                    <td>{{ str_pad($asistencia->miembro->id, 4, '0', STR_PAD_LEFT) }}</td>
                    <td>{{ $asistencia->miembro->nombre_apellido }}</td>
                    <td>{{ $asistencia->fecha }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>