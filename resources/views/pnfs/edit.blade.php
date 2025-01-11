@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 2%">
        <h1>Editar PNF: {{$pnf->nombre}}</h1>

        <br>
        <div class="row">
            <div class="col-md-11">
                <div class="card card-primary shadow">
                    <div class="card-header">
                        <h3 class="card-title text-center">Editar PNF</h3>
                    </div>
                    
                    <div class="card-body" style="display: block;">
                        <form action="{{ route('pnfs.update', $pnf->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Nombre del PNF</label>
                                                <input type="text" name="nombre" value="{{old('nombre', $pnf->nombre)}}" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{-- <label for="">Descripción</label>
                                                <textarea class="form-control" name="descripcion" placeholder="Agregue una descripción del PNF">{{old('descripcion', $pnf->descripcion)}}</textarea> --}}
                                            </div>
                                        </div>
                                    </div>

                                    <h4>Materias asociadas</h4>
                                    <div id="materias" class="row">
                                        @foreach($pnf->materias as $index => $materia)
                                            <div class="col-md-6" id="materia-{{$materia->id}}">
                                                <div class="form-group">
                                                    <label for="materia-{{$materia->id}}">Materia</label>
                                                    <input type="text" class="form-control" name="materias[{{$materia->id}}]" value="{{$materia->nombre}}" required>
                                                    <button type="button" class="btn btn-danger btn-sm mt-2" onclick="eliminarMateria({{$materia->id}})">Eliminar</button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <button type="button" class="btn btn-success" onclick="agregarMateria()">+ Agregar materia</button>
                                </div>
                            </div>
    
                            <hr>
    
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <a href="{{url('pnfs')}}" class="btn btn-danger">Cancelar</a>
                                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>  
            </div>
        </div>
    </div>

    <script>
        // Función para agregar una nueva materia
        function agregarMateria() {
            const materiaCount = document.querySelectorAll("#materias .col-md-6").length;
            const newMateriaId = 'new-' + materiaCount;
            const newMateriaHTML = `
                <div class="col-md-6" id="materia-${newMateriaId}">
                    <div class="form-group">
                        <label for="materia-${newMateriaId}">Materia</label>
                        <input type="text" class="form-control" name="materias[${newMateriaId}]" value="" required>
                        <button type="button" class="btn btn-danger btn-sm mt-2" onclick="eliminarMateria('${newMateriaId}')">Eliminar</button>
                    </div>
                </div>
            `;
            document.getElementById('materias').insertAdjacentHTML('beforeend', newMateriaHTML);
        }

        // Función para eliminar una materia
        function eliminarMateria(materiaId) {
            const materiaElement = document.getElementById('materia-' + materiaId);
            if (materiaElement) {
                materiaElement.remove();
            }
        }
    </script>
@endsection
