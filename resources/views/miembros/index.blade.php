@extends('layouts.admin')
@section('content')
    <div class="content" style="margin-left: 2%">
        <h1>Listado de miembros</h1>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary shadow">
                    <div class="card-header">
                        <h3 class="card-title text-center">Miembros registrados</h3>
                        @can('miembros.create')
                        <div class="card-tools">
                            <a href="{{url('/miembros/create')}}" class="btn btn-primary">
                                <i class="bi bi-person-plus" style="font-size: 112%;"> Agregar nuevo miembro</i>
                            </a>
                        </div>
                        @endcan
                    </div>
                    
                    <div class="card-body" style="display: block;">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombres y apellidos</th>
                                    <th>Cédula</th>
                                    <th>E-mail</th>
                                    <th>Cargo</th>
                                    <th>Estado</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($miembros as $miembro)
                                    <tr>
                                        <td>{{ str_pad($miembro->id, 4, '0', STR_PAD_LEFT) }}</td>
                                        <td>{{ $miembro->nombre_apellido }} </td>
                                        <td>{{ number_format($miembro->cedula, 0, '.', '.') }}</td>
                                        <td>{{ $miembro->email }}</td>
                                        <td>{{ $miembro->cargo->nombre_cargo }}</td>
                                        <td style="text-align: center">
                                            <button class="toggleButton btn btn-success btn-sm" style="border-radius: 20px">Activo</button>
                                        </td>
                                        <td style="text-align: center">
                                            <div class="btn-group" role="group">
                                                <a href="{{url('miembros', $miembro->id)}}" type="button" class="btn btn-info"><i class="bi bi-eye"></i></a>
                                            </div>
                                            @if($miembro->id != 1)
                                                @can('miembros.edit')
                                                <div class="btn-group" role="group">
                                                    <a href="{{route('miembros.edit', $miembro->id)}}" type="button" class="btn btn-success"><i class="bi bi-pencil-square"></i></a>
                                                </div>
                                                @endcan
                                                @can('miembros.destroy')
                                                <div class="btn-group" role="group">
                                                    <form action="{{url('miembros', $miembro->id)}}" class="formulario-eliminar" method="POST">
                                                        @csrf
                                                        {{method_field('DELETE')}}
                                                        <button type="submit" class="btn btn-danger" value=""><i class="bi bi-trash"></i></button>
                                                    </form>
                                                </div>
                                                @endcan
                                            @endif
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

@if($message = Session::get('mensaje'))
    <script>
        Swal.fire({
            title: "¡Felicidades!",
            text: "{{$message}}",
            icon: "success"
        });
    </script>
@endif

<script>
    $('.formulario-eliminar').submit(function(e){
        e.preventDefault();
        var nombre = "<b>{{$miembro->nombre_apellido}}</b>";
        Swal.fire({
            title: "¿Estás seguro?",
            html: "¿Deseas eliminar los registros de " + nombre + "?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sí, eliminarlo"
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });
    });
</script>
@if(session('eliminar') == 'eliminar')
    <script>
        Swal.fire({
        title: "¡Eliminado!",
        text: "Los datos han sido eliminados.",
        icon: "success"
        });
    </script>
@endif

<script>
    $(function () {
        // Script para buscar sin necesidad de signos ni simbolos
        $.fn.dataTable.ext.type.search.string = function (data) {
        return !data ?
            '' :
            typeof data === 'string' ?
                data
                    .replace(/[^\w\s]/gi, '') // Elimina caracteres especiales
                    .replace(/\s+/g, ' ') // Reemplaza múltiples espacios en blanco con uno solo
                    .trim() // Elimina espacios en blanco al principio y al final
                    .toLowerCase() : data;
        };
    $("#example1").DataTable({
        "pageLength": 10,
        "order": [[0, 'desc']],
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
        "responsive": true, "lengthChange": true, "autoWidth": false, "searchPanes": true,
        "search": {
            "smart": true,
            "regex": true,
        }, 
        // BOTÓN DE REPORTES:
        // buttons: [{
        //     extend: 'collection',
        //     text: 'Reportes',
        //     orientation: 'landscape',
        //     buttons: [
        //         { text: 'Imprimir como PDF', extend: 'pdf', exportOptions: { columns: ':not(:last-child, :nth-last-child(2))' } },
        //         { text: 'Imprimir como EXCEL',extend: 'excel', exportOptions: { columns: ':not(:last-child, :nth-last-child(2))' } },
        //     ]},
        // ],
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>

<script>
    $(document).ready(function() {
        // Cuando se hace clic en un botón con la clase toggleButton
        $('.toggleButton').click(function() {
            // Cambia el texto del botón y la clase de estilo solo para este botón
            if ($(this).hasClass('btn-success')) {
                $(this).removeClass('btn-success').addClass('btn-danger').text('Inactivo');
            } else {
                $(this).removeClass('btn-danger').addClass('btn-success').text('Activo');
            }
        });
    });
</script>

@endsection

