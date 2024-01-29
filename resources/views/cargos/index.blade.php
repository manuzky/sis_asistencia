@extends('layouts.admin')
@section('content')
    <div class="content" style="margin-left: 2%">
        <h1>Listado de cargos</h1>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary shadow">
                    <div class="card-header">
                        <h3 class="card-title text-center">Cargos registrados</h3>
                        <div class="card-tools">
                            <a href="{{url('/cargos/create')}}" class="btn btn-primary">
                                <i class="bi bi-person-plus" style="font-size: 112%;"> Agregar nuevo cargo</i>
                            </a>
                        </div>
                    </div>
                    
                    <div class="card-body" style="display: block;">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Cargo</th>
                                    <th>Descripción</th>
                                    <th>Fecha de ingreso</th>
                                    <th>Estado</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($cargos as $cargo)
                                    <tr>
                                        <td>{{ str_pad($cargo->id, 4, '0', STR_PAD_LEFT) }}</td>
                                        <td>{{$cargo->nombre_cargo}}</td>
                                        <td>{{$cargo->descripcion_cargo}}</td>
                                        <td>{{$cargo->fecha_ingreso_cargo}}</td>
                                        <td style="text-align: center">
                                            <button class="btn btn-success btn-sm" style="border-radius: 20px">Activo</button>
                                        </td>
                                        <td style="text-align: center">
                                            <div class="btn-group" role="group">
                                                <a href="{{url('cargos', $cargo->id)}}" type="button" class="btn btn-info"><i class="bi bi-eye"></i></a>
                                            </div>
                                            <div class="btn-group" role="group">
                                                <a href="{{route('cargos.edit', $cargo->id)}}" type="button" class="btn btn-success"><i class="bi bi-pencil-square"></i></a>
                                            </div>
                                            <div class="btn-group" role="group">
                                                <form action="{{url('cargos', $cargo->id)}}" method="POST">
                                                    @csrf
                                                    {{method_field('DELETE')}}
                                                    <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar el cargo: {{$cargo->nombre_cargo}}?')" class="btn btn-danger" value=""><i class="bi bi-trash"></i></button>
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
        </div>
    </div>

<script>
    $(function () {
    $("#example1").DataTable({
        "pageLength": 10,
        "order": [[0, 'desc']],
        "language": {
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Cargos",
            "infoEmpty": "Mostrando 0 a 0 de 0 Cargos",
            "infoFiltered": "(Filtrado de _MAX_ total Cargos)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Cargos",
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

