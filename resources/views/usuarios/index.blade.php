@extends('layouts.admin')
@section('content')
    <div class="content" style="margin-left: 2%">
        <h1>Listado de usuarios</h1>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary shadow">
                    <div class="card-header">
                        <h3 class="card-title text-center">Usuarios registrados</h3>
                        @can('usuarios.create')
                        <div class="card-tools">
                            <a href="{{url('/usuarios/create')}}" class="btn btn-primary">
                                <i class="bi bi-person-plus" style="font-size: 112%;"> Agregar nuevo usuario</i>
                            </a>
                        </div>
                        @endcan
                    </div>
                    
                    <div class="card-body" style="display: block;">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre del usuario</th>
                                    <th>Email</th>
                                    <th>Fecha de ingreso</th>
                                    <th>Estado</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($usuarios as $usuario)
                                    <tr>
                                        <td>{{ str_pad($usuario->id, 4, '0', STR_PAD_LEFT) }}</td>
                                        <td>{{$usuario->name}}</td>
                                        <td>{{$usuario->email}}</td>
                                        <td><?php echo date('d/m/Y', strtotime($usuario->fecha_ingreso)); ?></td>
                                        <td style="text-align: center">
                                            <button class="btn btn-success btn-sm" style="border-radius: 20px">Activo</button>
                                        </td>
                                        <td style="text-align: center">
                                            <div class="btn-group" role="group">
                                                <a href="{{url('usuarios', $usuario->id)}}" type="button" class="btn btn-info"><i class="bi bi-eye"></i></a>
                                            </div>
                                            @if($usuario->id != 1) 
                                                @can('usuarios.edit')
                                                <div class="btn-group" role="group">
                                                    <a href="{{route('usuarios.edit', $usuario->id)}}" type="button" class="btn btn-success"><i class="bi bi-pencil-square"></i></a>
                                                </div>
                                                @endcan
                                                @can('usuarios.destroy')
                                                <div class="btn-group" role="group">
                                                    <form action="{{url('usuarios', $usuario->id)}}" class="formulario-eliminar" method="POST">
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

{{-- SCRIPTS --}}
<div>
        {{-- SWEETALERT AL ELIMINAR USUARIO --}}
        <script>
            $('.formulario-eliminar').submit(function(e){
                e.preventDefault();
                var nombre = "<b>{{$usuario->name}}</b>";
                Swal.fire({
                    title: "¿Estás seguro?",
                    html: "¿Deseas eliminar el usuario " + nombre + "?",
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
        {{-- SWEETALERT RECARGA LA PÁGINA AL ELIMINAR USUARIO --}}
        @if(session('eliminar') == 'eliminar')
            <script>
                Swal.fire({
                title: "¡Eliminado!",
                text: "Los datos han sido eliminados.",
                icon: "success"
                });
            </script>
        @endif
    
        {{-- DATATABLES --}}
        <script>
            $(function () {
            $("#example1").DataTable({
                "pageLength": 10,
                "order": [[0, 'desc']],
                "language": {
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Usuarios",
                    "infoEmpty": "Mostrando 0 a 0 de 0 Usuarios",
                    "infoFiltered": "(Filtrado de _MAX_ total Usuarios)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Usuarios",
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
    
        {{-- SWEETALERT MENSAJE AL AÑADIR NUEVO USUARIO --}}
        @if($message = Session::get('mensaje'))
            <script>
                    Swal.fire({
                        title: "¡Felicidades!",
                        text: "{{$message}}",
                        icon: "success"
                    });
            </script>
        @endif
</div>

@endsection

