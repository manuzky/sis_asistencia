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
                                    <div id="materias-container">
                                        <div class="form-group materia-group">
                                            <label for="">Materia</label>
                                            <input type="text" name="materias[]" class="form-control" placeholder="Ingrese el nombre de la materia" required>
                                            <button type="button" class="btn btn-danger btn-sm remove-materia" style="margin-top: 5px;">Eliminar</button>
                                        </div>
                                    </div>
                                    
                                    <button type="button" id="add-materia" class="btn btn-success btn-sm" style="margin-top: 10px;">+ Agregar materia</button>
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
        // Agregar nueva materia
        document.getElementById('add-materia').addEventListener('click', function() {
            var container = document.getElementById('materias-container');
            var newMateriaGroup = document.createElement('div');
            newMateriaGroup.classList.add('form-group', 'materia-group');
            newMateriaGroup.innerHTML = `
                <label for="">Materia</label>
                <input type="text" name="materias[]" class="form-control" placeholder="Ingrese el nombre de la materia" required>
                <button type="button" class="btn btn-danger btn-sm remove-materia" style="margin-top: 5px;">Eliminar</button>
            `;
            container.appendChild(newMateriaGroup);

            // Volver a agregar el evento de eliminar
            addRemoveMateriaEvent();
        });

        // Función para agregar el evento de eliminación a los botones
        function addRemoveMateriaEvent() {
            var removeButtons = document.querySelectorAll('.remove-materia');
            removeButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    this.parentElement.remove();
                });
            });
        }

        // Inicializamos el evento de eliminación de materias
        addRemoveMateriaEvent();
    </script>
@endsection
