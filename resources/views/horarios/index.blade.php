@extends('layouts.admin')
@section('content')
    <div class="content" style="margin-left: 2%">
        <h1>Listado de horarios</h1>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary shadow">
                    <div class="card-header">
                        <h3 class="card-title text-center">Horarios registrados</h3>
                        @can('horarios.create')
                        <div class="card-tools">
                            <a href="{{url('/horarios/create')}}" class="btn btn-primary">
                                <i class="bi bi-person-plus" style="font-size: 112%;"> Agregar nuevo horario</i>
                            </a>
                        </div>
                        @endcan
                    </div>
                    
                    <div class="card-body" style="display: block;">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nº</th>
                                    <th>Turno</th>
                                    <th>PNF</th>
                                    <th>Trayecto</th>
                                    <th>Semestre</th>
                                    <th>Sección</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = 0 ?>
                                @foreach($horarios as $horario)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{$horario->turno}}</td>
                                        <td>{{$horario->pnf->nombre}}</td>
                                        <td>{{$horario->trayecto}}</td>
                                        <td>{{$horario->semestre}}</td>
                                        <td>{{$horario->seccion}}</td>
                                        <td style="text-align: center">
                                            <div class="btn-group" role="group">
                                                <a href="{{url('horarios', $horario->id)}}" type="button" class="btn btn-info"><i class="bi bi-eye"></i></a>
                                            </div>
                                            <div class="btn-group" role="group">
                                                <a href="{{route('horarios.edit', $horario->id)}}" type="button" class="btn btn-success"><i class="bi bi-pencil-square"></i></a>
                                            </div>
                                            <div class="btn-group" role="group">
                                                <form action="{{url('horarios', $horario->id)}}" class="formulario-eliminar" method="POST">
                                                    @csrf
                                                    {{method_field('DELETE')}}
                                                    <button type="submit" class="btn btn-danger" value=""><i class="bi bi-trash"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>

                                    {{-- SWEETALERT PARA ELIMINAR --}}
                                    <script>
                                        $('.formulario-eliminar').submit(function(e){
                                            e.preventDefault();
                                            var nombre = "<b>{{$horario->pnf->nombre_pnf}}</b>"; // Aquí pasas la variable correcta del horario
                                            Swal.fire({
                                                title: "¿Estás seguro?",
                                                html: "¿Deseas eliminar el horario " + nombre + "?",
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
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>  
            </div>
        </div>
    </div>

{{-- DATATABLES --}}
<script>
    $(function () {
        $.fn.dataTable.ext.type.search.string = function (data) {
            return !data ? '' : typeof data === 'string' ? data
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
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Horarios",
                "infoEmpty": "Mostrando 0 a 0 de 0 Horarios",
                "infoFiltered": "(Filtrado de _MAX_ total Horarios)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Horarios",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscador:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
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

@endsection
