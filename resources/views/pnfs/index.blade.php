@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 2%">
        <h1>Listado de Carreras (PNF)</h1>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary shadow">
                    <div class="card-header">
                        <h3 class="card-title text-center">Carreras registradas</h3>
                        {{-- @can('pnfs.create') --}}
                        <div class="card-tools">
                            <a href="{{url('/pnfs/create')}}" class="btn btn-primary">
                                <i class="bi bi-person-plus" style="font-size: 112%;"> Agregar nueva carrera</i>
                            </a>
                        </div>
                        {{-- @endcan --}}
                    </div>
                    
                    <div class="card-body" style="display: block;">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nº</th>
                                    <th>Carrera</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = 0 ?>
                                @foreach($pnfs as $pnf)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{$pnf->nombre}}</td>  <!-- Muestra el nombre del PNF -->
                                        <td style="text-align: center">
                                            <div class="btn-group" role="group">
                                                <a href="{{url('pnfs', $pnf->id)}}" type="button" class="btn btn-info"><i class="bi bi-eye"></i></a>
                                            </div>
                                            {{-- @can('pnfs.edit') --}}
                                            <div class="btn-group" role="group">
                                                <a href="{{route('pnfs.edit', $pnf->id)}}" type="button" class="btn btn-success"><i class="bi bi-pencil-square"></i></a>
                                            </div>
                                            {{-- @endcan
                                            @can('pnfs.destroy') --}}
                                            <div class="btn-group" role="group">
                                                <form action="{{url('pnfs', $pnf->id)}}" class="formulario-eliminar" method="POST">
                                                    @csrf
                                                    {{method_field('DELETE')}}
                                                    <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                                </form>
                                            </div>
                                            {{-- @endcan --}}
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
    <script>
    $('.formulario-eliminar').submit(function(e){
        e.preventDefault();
        
        // Obtener el nombre desde el atributo 'data-nombre'
        var nombre = $(this).data('nombre');
        
        Swal.fire({
            title: "¿Estás seguro?",
            html: "¿Deseas eliminar la carrera <b>" + nombre + "</b>?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sí, eliminarla"
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

    <script>
        $(function () {
            $.fn.dataTable.ext.type.search.string = function (data) {
            return !data ?
                '' :
                typeof data === 'string' ?
                    data
                        .replace(/[^\w\s]/gi, '')
                        .replace(/\s+/g, ' ')
                        .trim()
                        .toLowerCase() : data;
            };
            $("#example1").DataTable({
                "pageLength": 10,
                "order": [[0, 'desc']],
                "language": {
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Carreras",
                    "infoEmpty": "Mostrando 0 a 0 de 0 Carreras",
                    "infoFiltered": "(Filtrado de _MAX_ total Carreras)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Carreras",
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
                }
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
@endsection
