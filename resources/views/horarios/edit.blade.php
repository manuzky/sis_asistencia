@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 2%">
        <h1>Editar Horario</h1>

        <!-- Mostrar errores de validación -->
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">
                <li>{{ $error }}</li>
            </div>
        @endforeach

        <br>
        <div class="row">
            <div class="col-md-11">
                <div class="card card-primary shadow">
                    <div class="card-header">
                        <h3 class="card-title text-center">Datos a editar</h3>
                    </div>

                    <div class="card-body" style="display: block;">
                        <form action="{{ route('horarios.update', $horario->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-12">
                                    <h6 style="color: red">Los campos con (<b>*</b>) son obligatorios</h6>
                                    <div class="row">
                                        <!-- Turno -->
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="turno">Turno <b style="color:red">*</b></label>
                                                <select name="turno" id="turno" class="form-control" required>
                                                    <option value=""></option>
                                                    <option value="Mañana"
                                                        {{ old('turno', $horario->turno) == 'Mañana' ? 'selected' : '' }}>
                                                        Mañana</option>
                                                    <option value="Tarde"
                                                        {{ old('turno', $horario->turno) == 'Tarde' ? 'selected' : '' }}>
                                                        Tarde</option>
                                                    <option value="Noche"
                                                        {{ old('turno', $horario->turno) == 'Noche' ? 'selected' : '' }}>
                                                        Noche</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- PNF -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="pnf_id">PNF <b style="color:red">*</b></label>
                                                <select name="pnf_id" id="pnf_id" class="form-control" required>
                                                    <option value=""></option>
                                                    @foreach ($pnfs as $pnf)
                                                        <option value="{{ $pnf->id }}"
                                                            {{ old('pnf_id', $horario->pnf_id) == $pnf->id ? 'selected' : '' }}>
                                                            {{ $pnf->nombre }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Trayecto -->
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="trayecto">Trayecto <b style="color:red">*</b></label>
                                                <select name="trayecto" id="trayecto" class="form-control" required>
                                                    <option value=""></option>
                                                    <option value="Inicial"
                                                        {{ old('trayecto', $horario->trayecto) == 'Inicial' ? 'selected' : '' }}>
                                                        Inicial</option>
                                                    <option value="1"
                                                        {{ old('trayecto', $horario->trayecto) == '1' ? 'selected' : '' }}>1
                                                    </option>
                                                    <option value="2"
                                                        {{ old('trayecto', $horario->trayecto) == '2' ? 'selected' : '' }}>
                                                        2</option>
                                                    <option value="3"
                                                        {{ old('trayecto', $horario->trayecto) == '3' ? 'selected' : '' }}>
                                                        3</option>
                                                    <option value="4"
                                                        {{ old('trayecto', $horario->trayecto) == '4' ? 'selected' : '' }}>
                                                        4</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Semestre -->
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="semestre">Semestre <b style="color:red">*</b></label>
                                                <select name="semestre" id="semestre" class="form-control" required>
                                                    <option value=""></option>
                                                    <option value="1"
                                                        {{ old('semestre', $horario->semestre) == '1' ? 'selected' : '' }}>
                                                        1</option>
                                                    <option value="2"
                                                        {{ old('semestre', $horario->semestre) == '2' ? 'selected' : '' }}>
                                                        2</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Sección -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="seccion">Sección <b style="color:red">*</b></label>
                                                <input type="text" name="seccion" id="seccion" class="form-control"
                                                    value="{{ old('seccion', $horario->seccion) }}" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <!-- Tabla de Horario -->
                            <h5>Horarios</h5>
                            <table class="table table-bordered" id="tabla-horarios">
                                <thead>
                                    <tr>
                                        <th>Hora</th>
                                        <th>Lunes</th>
                                        <th>Martes</th>
                                        <th>Miércoles</th>
                                        <th>Jueves</th>
                                        <th>Viernes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($horario->materias as $horarioMateria)
                                        <tr>
                                            <td>{{ $horarioMateria->pivot->hora }}</td> <!-- Hora obtenida del pivote -->
                                            @foreach (['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'] as $dia)
                                                <td>
                                                    <select
                                                        name="horarios[{{ $dia }}][{{ $horarioMateria->pivot->hora }}]"
                                                        class="form-control">
                                                        <option value="">---</option>
                                                        @foreach ($materias as $materia)
                                                            <option value="{{ $materia->id }}"
                                                                {{ $materia->id == $horarioMateria->id && $horarioMateria->pivot->dia == $dia ? 'selected' : '' }}>
                                                                {{ $materia->nombre }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <hr>

                            <!-- Tabla de Materias y Profesor -->
                            <h5>Materias y Profesor</h5>
                            <table class="table table-bordered" id="tabla-materias">
                                <thead>
                                    <tr>
                                        <th>Materia</th>
                                        <th>Profesor</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($horario->materias as $index => $materia)
                                        <tr>
                                            <!-- Campo para seleccionar la materia -->
                                            <td>
                                                <select name="materias[]" class="form-control materia-dropdown">
                                                    <option value=""></option>
                                                    @foreach ($materias as $materiaOption)
                                                        <option value="{{ $materiaOption->id }}"
                                                            {{ old('materias.' . $index, $materia->id) == $materiaOption->id ? 'selected' : '' }}>
                                                            {{ $materiaOption->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>

                                            <!-- Campo para seleccionar el profesor -->
                                            <td>
                                                <select name="profesor_id[]" class="form-control profesor-dropdown">
                                                    <option value=""></option>
                                                    @foreach ($docentes as $docente)
                                                        <option value="{{ $docente->id }}"
                                                            {{ old('profesor_id.' . $index, $materia->pivot->profesor_id) == $docente->id ? 'selected' : '' }}>
                                                            {{ $docente->nombre_apellido }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>

                                            <!-- Campo para eliminar una fila -->
                                            <td>
                                                <button type="button"
                                                    class="btn btn-danger eliminar-fila">Eliminar</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>


                            <!-- Botón para agregar más filas -->
                            <button type="button" class="btn btn-success" id="agregar-materia">Agregar Materia</button>

                            <hr>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <a href="{{ route('horarios.index') }}" class="btn btn-danger">Cancelar</a>
                                        <button type="submit" class="btn btn-primary">Actualizar</button>
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
        document.getElementById('agregar-materia').addEventListener('click', function() {
            const tablaMaterias = document.getElementById('tabla-materias').getElementsByTagName('tbody')[0];
            const nuevaFila = tablaMaterias.insertRow();
            const materias = {!! json_encode($materias) !!};
            const docentes = {!! json_encode($docentes) !!};

            // Columna 1: Dropdown de Materia
            let celdaMateria = nuevaFila.insertCell();
            let selectMateria = document.createElement('select');
            selectMateria.name = 'materias[]';
            selectMateria.className = 'form-control materia-dropdown';

            // Agregar opción vacía
            selectMateria.innerHTML = '<option value=""></option>';

            // Agregar las materias existentes
            materias.forEach(function(materia) {
                let option = document.createElement('option');
                option.value = materia.id;
                option.textContent = materia.nombre;
                selectMateria.appendChild(option);
            });

            celdaMateria.appendChild(selectMateria);

            // Columna 2: Dropdown de Profesor
            let celdaProfesor = nuevaFila.insertCell();
            let selectProfesor = document.createElement('select');
            selectProfesor.name = 'profesor_id[]';
            selectProfesor.className = 'form-control profesor-dropdown';

            // Agregar opción vacía
            selectProfesor.innerHTML = '<option value=""></option>';

            // Agregar los docentes existentes
            docentes.forEach(function(docente) {
                let option = document.createElement('option');
                option.value = docente.id;
                option.textContent = docente.nombre_apellido;
                selectProfesor.appendChild(option);
            });

            celdaProfesor.appendChild(selectProfesor);

            // Columna 3: Botón Eliminar
            let celdaAccion = nuevaFila.insertCell();
            let botonEliminar = document.createElement('button');
            botonEliminar.type = 'button';
            botonEliminar.className = 'btn btn-danger eliminar-fila';
            botonEliminar.textContent = 'Eliminar';
            celdaAccion.appendChild(botonEliminar);

            // Eliminar fila al hacer clic en "Eliminar"
            botonEliminar.addEventListener('click', function() {
                nuevaFila.remove();
            });
        });

        // Función para cargar las materias dinámicamente (sin reiniciar las seleccionadas)
        function cargarMaterias(reset = true) {
            const pnf_id = document.getElementById('pnf_id').value;
            const dropdownsMaterias = document.querySelectorAll('.materia-dropdown');

            // Limpiar las materias de todos los dropdowns solo si 'reset' es true
            if (reset) {
                dropdownsMaterias.forEach(function(dropdown) {
                    dropdown.innerHTML = '<option value=""></option>';
                });
            }

            if (pnf_id) {
                fetch(`/api/materias/${pnf_id}`)
                    .then(response => response.json())
                    .then(data => {
                        dropdownsMaterias.forEach(function(dropdown) {
                            data.materias.forEach(function(materia) {
                                let option = document.createElement('option');
                                option.value = materia.id;
                                option.textContent = materia.nombre;

                                // Verifica si la materia está seleccionada para la fila actual
                                const selectedMateria = dropdown.closest('tr').querySelector(
                                    '.materia-id').value;
                                if (selectedMateria && selectedMateria == materia.id) {
                                    option.selected = true;
                                }

                                dropdown.appendChild(option);
                            });
                        });
                    })
                    .catch(error => console.log('Error al cargar las materias:', error));
            }
        }

        // Función para cargar los profesores dinámicamente
        function cargarProfesores(reset = true) {
            const dropdownsProfesores = document.querySelectorAll('.profesor-dropdown');

            // Limpiar los profesores de todos los dropdowns solo si 'reset' es true
            if (reset) {
                dropdownsProfesores.forEach(function(dropdown) {
                    dropdown.innerHTML = '<option value=""></option>';
                });
            }

            const docentes = {!! json_encode($docentes) !!}; // Convierte la variable PHP a JavaScript

            dropdownsProfesores.forEach(function(dropdown) {
                docentes.forEach(function(docente) {
                    let option = document.createElement('option');
                    option.value = docente.id;
                    option.textContent = docente.nombre_apellido;

                    // Verifica si el docente está seleccionado
                    const selectedProfesor = dropdown.closest('tr').querySelector('.profesor-id').value;
                    if (selectedProfesor && selectedProfesor == docente.id) {
                        option.selected = true;
                    }

                    dropdown.appendChild(option);
                });
            });
        }
    </script>
    <!-- JavaScript para manejar los horarios dinámicamente -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Definir las horas por turno
            const horasPorTurno = {
                'Mañana': [
                    '8:00 – 8:45', '8:45 – 9:30', '9:30 – 10:15',
                    '10:15 – 11:00', '11:00 – 11:45', '11:45 – 12:30'
                ],
                'Tarde': [
                    '12:30 – 1:15', '1:15 – 2:00', '2:00 – 2:45',
                    '2:45 – 3:30', '3:30 – 4:15', '4:15 – 5:00'
                ],
                'Noche': [
                    '5:00 – 5:30', '5:30 – 6:00', '6:00 – 6:30',
                    '6:30 – 7:00', '7:00 – 7:30', '7:30 – 8:00'
                ]
            };

            const tablaHorarios = document.getElementById('tabla-horarios').getElementsByTagName('tbody')[0];
            const turnoSeleccionado = document.getElementById('turno').value; // Obtener el turno seleccionado

            // Verificar los datos
            const materias = {!! json_encode($materias) !!};
            const horariosAsignados = {!! json_encode($horariosAsignados) !!};

            // Crear un mapa para las horas y los días
            const horarios = {};

            // Inicializar las horas por turno
            horasPorTurno[turnoSeleccionado].forEach(function(hora) {
                horarios[hora] = {
                    'Lunes': null,
                    'Martes': null,
                    'Miércoles': null,
                    'Jueves': null,
                    'Viernes': null
                };
            });

            // Asignar las materias a las horas y días correspondientes
            for (const dia in horariosAsignados[turnoSeleccionado]) {
                for (const hora in horariosAsignados[turnoSeleccionado][dia]) {
                    const materiaAsignada = horariosAsignados[turnoSeleccionado][dia][hora];
                    horarios[hora][dia] = materiaAsignada;
                }
            }

            // Crear las filas de la tabla, pero solo para las horas que existen en el turno
            Object.keys(horarios).forEach(function(hora) {
                // Crear una fila por cada hora
                let fila = tablaHorarios.insertRow();

                // Hora
                let celdaHora = fila.insertCell();
                celdaHora.textContent = hora;

                // Iterar sobre los días
                ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'].forEach(function(dia) {
                    let celdaDia = fila.insertCell();
                    let select = document.createElement('select');
                    select.name = `horarios[${dia}][${hora}]`;
                    select.className = 'form-control';

                    // Verificar si ya hay una materia asignada para esta hora y día
                    if (horarios[hora][dia]) {
                        let option = document.createElement('option');
                        option.value = horarios[hora][dia].id;
                        option.textContent = horarios[hora][dia].nombre;
                        option.selected = true; // Marcar la opción como seleccionada
                        select.appendChild(option);
                    } else {
                        // Opción vacía por defecto si no hay materia asignada
                        let opcionVacia = document.createElement('option');
                        opcionVacia.value = '';
                        opcionVacia.textContent = '---';
                        select.appendChild(opcionVacia);

                        // Cargar todas las materias disponibles si no hay materia asignada
                        materias.forEach(function(materia) {
                            let option = document.createElement('option');
                            option.value = materia.id;
                            option.textContent = materia.nombre;
                            select.appendChild(option);
                        });
                    }

                    // Añadir el select a la celda correspondiente
                    celdaDia.appendChild(select);
                });
            });
        });
    </script>
@endsection
