@extends('layouts.admin')
@section('content')
    <div class="content" style="margin-left: 2%">
        <h1>Listado de roles</h1>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary shadow">
                    <div class="card-header">
                        <h3 class="card-title text-center">Cargos registrados</h3>
                        @can('rolesypermisos.create')
                        <div class="card-tools">
                            <a href="{{url('/rolesypermisos/create')}}" class="btn btn-primary">
                                <i class="bi bi-person-plus" style="font-size: 112%;"> Agregar nuevo rol</i>
                            </a>
                        </div>
                        @endcan
                    </div>
                    
                    <div class="card-body" style="display: block;">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nº</th>
                                    <th>Rol</th>
                                    <th>Descripción</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = 0 ?>
                                @foreach($roles as $role)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>{{ $role->description }}</td>
                                        <td style="text-align: center">
                                            <div class="btn-group" role="group">
                                                <a href="{{url('rolesypermisos', $role->id)}}" type="button" class="btn btn-info"><i class="bi bi-eye"></i></a>
                                            </div>
                                            @can('rolesypermisos.edit')
                                            <div class="btn-group" role="group">
                                                <a href="{{route('rolesypermisos.edit', $role->id)}}" type="button" class="btn btn-success"><i class="bi bi-pencil-square"></i></a>
                                            </div>
                                            @endcan
                                            @can('rolesypermisos.destroy')
                                            <div class="btn-group" role="group">
                                                <form action="{{url('rolesypermisos', $role->id)}}" method="POST">
                                                    @csrf
                                                    {{method_field('DELETE')}}
                                                    <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar el rol: {{ $role->name}}?')" class="btn btn-danger" value=""><i class="bi bi-trash"></i></button>
                                                </form>
                                            </div>
                                            @endcan
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

