@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <h1>Listado de asistencias</h1>

        <div class="row">
            <div class="col-sm-12">
                <div class="card card-primary shadow">
                    <div class="card-header">
                        <h3 class="card-title text-center">Asistencias registradas</h3>
                        <div class="card-tools">
                            <a href="{{url('/asistencias/create')}}" class="btn btn-primary">
                                <i class="bi bi-person-plus" style="font-size: 112%;"> Agregar nueva asistencia</i>
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead class="thead">
                                    <tr>
                                        <th>Nº</th>
                                        <th>ID</th>
										<th>Nombres y Apellidos</th>
										<th>Fecha</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($asistencias as $asistencia)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ str_pad($asistencia->miembro->id, 4, '0', STR_PAD_LEFT) }}</td>
											<td>{{ $asistencia->miembro->nombre_apellido }}</td>
											<td>{{ $asistencia->fecha }}</td>
                                            <td style="text-align: center">
                                                <div class="btn-group" role="group">
                                                    <a href="{{route('asistencias.show', $asistencia->id)}}" type="button" class="btn btn-info"><i class="bi bi-eye"></i></a>
                                                </div>
                                                <div class="btn-group" role="group">
                                                    <a href="{{route('asistencias.edit', $asistencia->id)}}" type="button" class="btn btn-success"><i class="bi bi-pencil-square"></i></a>
                                                </div>
                                                <div class="btn-group" role="group">
                                                    <form action="{{route('asistencias.destroy', $asistencia->id)}}" method="POST">
                                                        @csrf
                                                        {{method_field('DELETE')}}
                                                        <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar la asistencia de {{$asistencia->miembro->nombre_apellido}}?')" class="btn btn-danger" value=""><i class="bi bi-trash"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $asistencias->links() !!}
            </div>
        </div>
    </div>

    <script>
        $(function () {
        $("#example1").DataTable({
            "pageLength": 10,
            "order": [[0, 'desc']],
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Asistencias",
                "infoEmpty": "Mostrando 0 a 0 de 0 Asistencias",
                "infoFiltered": "(Filtrado de _MAX_ total Asistencias)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Asistencias",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscador:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            "responsive": true, "lengthChange": true, "autoWidth": false,
            buttons: [{
                extend: 'collection',
                text: 'Reportes',
                orientation: 'landscape',
                buttons: [
                    { text: 'Imprimir como PDF', extend: 'pdf', exportOptions: { columns: ':not(:last-child, :nth-last-child(2))' } },
                    { text: 'Imprimir como EXCEL',extend: 'excel', exportOptions: { columns: ':not(:last-child, :nth-last-child(2))' } },
                ]
            },
            ],
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
    
    @if($message = Session::get('mensaje'))
    <script>
            Swal.fire({
                title: "¡Felicidades!",
                text: "{{$message}}",
                icon: "success"
            });
    </script>
    @endif

@endsection
