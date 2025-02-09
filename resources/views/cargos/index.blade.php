@extends('layouts.admin')
@section('content')
    <div class="content" style="margin-left: 2%">
        <h1>Listado de personal</h1>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary shadow">
                    <div class="card-header">
                        <h3 class="card-title text-center">Personal registrados</h3>
                        @can('cargos.create')
                        <div class="card-tools">
                            <a href="{{url('/cargos/create')}}" class="btn btn-primary">
                                <i class="bi bi-person-plus" style="font-size: 112%;"> Agregar nuevo personal</i>
                            </a>
                        </div>
                        @endcan
                    </div>
                    
                    <div class="card-body" style="display: block;">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nº</th>
                                    <th>Personal</th>
                                    <th>Descripción</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = 0 ?>
                                @foreach($cargos as $cargo)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{$cargo->nombre_cargo}}</td>
                                        <td>{{$cargo->descripcion_cargo}}</td>
                                        <td style="text-align: center">
                                            <div class="btn-group" role="group">
                                                <a href="{{url('cargos', $cargo->id)}}" type="button" class="btn btn-info"><i class="bi bi-eye"></i></a>
                                            </div>
                                            @if($cargo->id != 1)
                                                @can('cargos.edit')
                                                <div class="btn-group" role="group">
                                                    <a href="{{route('cargos.edit', $cargo->id)}}" type="button" class="btn btn-success"><i class="bi bi-pencil-square"></i></a>
                                                </div>
                                                @endcan
                                                @can('cargos.destroy')
                                                <div class="btn-group" role="group">
                                                    <form action="{{url('cargos', $cargo->id)}}" class="formulario-eliminar" method="POST">
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
    {{-- SWEETALERT PARA ELIMINAR --}}
    <script>
        $('.formulario-eliminar').submit(function(e){
            e.preventDefault();
            var nombre = "<b>{{$cargo->nombre_cargo}}</b>";
            Swal.fire({
                title: "¿Estás seguro?",
                html: "¿Deseas eliminar el cargo " + nombre + "?",
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
    {{-- SWEETALERT RECARGA LA PAGINA AL ELIMINAR --}}
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
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Personal",
                "infoEmpty": "Mostrando 0 a 0 de 0 Personal",
                "infoFiltered": "(Filtrado de _MAX_ total Personal)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Personal",
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

    {{-- SWEETALERT AL AÑADIR CARGO --}}
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

