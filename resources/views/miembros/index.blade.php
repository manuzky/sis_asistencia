@extends('layouts.admin')
@section('content')
    <div class="content" style="margin-left: 2%">
        <h1>Listado de miembros</h1>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary shadow">
                    <div class="card-header">
                        <h3 class="card-title text-center">Miembros registrados</h3>
                        <div class="card-tools">
                            <a href="{{url('/miembros/create')}}" class="btn btn-primary">
                                <i class="bi bi-person-plus" style="font-size: 112%;"> Agregar nuevo miembro</i>
                            </a>
                        </div>
                    </div>
                    
                    <div class="card-body" style="display: block;">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombres y apellidos</th>
                                    <th>Cédula</th>
                                    <th>Teléfono</th>
                                    <th>E-mail</th>
                                    <th>Estado</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($miembros as $miembro)
                                    <tr>
                                        <td>{{ str_pad($miembro->id, 4, '0', STR_PAD_LEFT) }}</td>
                                        <td>{{$miembro->nombre_apellido}}</td>
                                        <td>{{ number_format($miembro->cedula, 0, '.', '.') }}</td>
                                        <td>{{substr_replace(substr_replace($miembro->telefono, '-', 4, 0), '.', 8, 0)}}</td>
                                        <td>{{$miembro->email}}</td>
                                        <td>{{$miembro->estado}}</td>
                                        <td></td>
                                    </tr>
                                @endforeach
                            </tbody>

                            <script>
                                $(function () {
                                $("#example1").DataTable({
                                    "pageLength": 10,
                                    "language": {
                                        "emptyTable": "No hay información",
                                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Miembros",
                                        "infoEmpty": "Mostrando 0 a 0 de 0 Miembros",
                                        "infoFiltered": "(Filtrado de _MAX_ total Miembros)",
                                        "infoPostFix": "",
                                        "thousands": ",",
                                        "lengthMenu": "Mostrar _MENU_ Miembros",
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
                        </table>
                    </div>
                </div>  
            </div>
        </div>

    </div>
@endsection

