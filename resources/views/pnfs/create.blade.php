@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 2%">
        <h1>Creación de un nuevo PNF</h1>

        @foreach($errors->all() as $error)
            <div class="alert alert-danger">
                <li>{{$error}}</li>
            </div>
        @endforeach
        <br>
        
        <div class="row">
            <div class="col-md-11">
                <div class="card card-primary shadow">
                    <div class="card-header">
                        <h3 class="card-title text-center">Datos a agregar</h3>
                    </div>
                    
                    <div class="card-body" style="display: block;">
                        <form action="{{url('/pnfs')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <h6 style="color: red">Los campos con (<b>*</b>) son obligatorios</h6>
                                    
                                    <!-- Campo de nombre del PNF -->
                                    <div class="form-group">
                                        <label for="">Nombre del PNF</label><b style="color:red"> *</b>
                                        <input type="text" name="nombre" value="{{old('nombre')}}" class="form-control" placeholder="Ingrese el nombre del PNF" required>
                                    </div>
                                    
                                    <!-- Sección de materias -->
                                    <h4>Materias asociadas</h4>
                                    <div id="materias" class="row">
                                        <div class="col-md-6" id="materia-new-0">
                                            <div class="form-group">
                                                <label for="materia-new-0">Materia</label>
                                                <input type="text" class="form-control" name="materias[new-0]" placeholder="Ingrese el nombre de la materia" required>
                                                <button type="button" class="btn btn-danger btn-sm mt-2" onclick="eliminarMateria('new-0')">Eliminar</button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <button type="button" class="btn btn-success mt-2" onclick="agregarMateria()">+ Agregar materia</button>
                                </div>
                            </div>
    
                            <hr>
    
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <a href="{{url('pnfs')}}" class="btn btn-danger">Cancelar</a>
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>  
            </div>
        </div>
    </div>

    <!-- Script para agregar y eliminar materias dinámicamente -->
    <script>
        // Función para agregar una nueva materia
        function agregarMateria() {
            const materiaCount = document.querySelectorAll("#materias .col-md-6").length;
            const newMateriaId = 'new-' + materiaCount;
            const newMateriaHTML = `
                <div class="col-md-6" id="materia-${newMateriaId}">
                    <div class="form-group">
                        <label for="materia-${newMateriaId}">Materia</label>
                        <input type="text" class="form-control" name="materias[${newMateriaId}]" placeholder="Ingrese el nombre de la materia" required>
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
