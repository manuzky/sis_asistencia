<!-- resources/views/horarios/create.blade.php -->
@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 2%">
        <h1>Creación de un nuevo horario</h1>

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
                        <h3 class="card-title text-center">Datos a agregar</h3>
                    </div>

                    <div class="card-body" style="display: block;">
                        <form action="{{ route('horarios.store') }}" method="POST">
                            @csrf

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
                                                    <option value="Mañana" {{ old('turno') == 'Mañana' ? 'selected' : '' }}>
                                                        Mañana</option>
                                                    <option value="Tarde" {{ old('turno') == 'Tarde' ? 'selected' : '' }}>
                                                        Tarde</option>
                                                    <option value="Noche" {{ old('turno') == 'Noche' ? 'selected' : '' }}>
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
                                                            {{ old('pnf_id') == $pnf->id ? 'selected' : '' }}>
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
                                                        {{ old('trayecto') == 'Inicial' ? 'selected' : '' }}>Inicial
                                                    </option>
                                                    <option value="1" {{ old('trayecto') == '1' ? 'selected' : '' }}>1
                                                    </option>
                                                    <option value="2" {{ old('trayecto') == '2' ? 'selected' : '' }}>2
                                                    </option>
                                                    <option value="3" {{ old('trayecto') == '3' ? 'selected' : '' }}>3
                                                    </option>
                                                    <option value="4" {{ old('trayecto') == '4' ? 'selected' : '' }}>4
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Semestre -->
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="semestre">Semestre <b style="color:red">*</b></label>
                                                <select name="semestre" id="semestre" class="form-control" required>
                                                    <option value=""></option>
                                                    <option value="1" {{ old('semestre') == '1' ? 'selected' : '' }}>1
                                                    </option>
                                                    <option value="2" {{ old('semestre') == '2' ? 'selected' : '' }}>2
                                                    </option>
                                                </select>
                                            </div>
                                        </div>


                                        <!-- Sección -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="seccion">Sección <b style="color:red">*</b></label>
                                                <input type="text" name="seccion" id="seccion" class="form-control"
                                                    value="{{ old('seccion') }}" required>
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
                                    <!-- Las horas se generarán dinámicamente con JS -->
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
                                    
                                </tbody>
                            </table>

                            <!-- Botón para agregar más filas -->
                            <button type="button" class="btn btn-success" id="agregar-materia" hidden>Agregar Materia</button>
                            {{-- ↑↑↑ ESTE BOTÓN NO SE PUEDE ELIMINAR O ROMPE EL CÓDIGO JAJAJAJAJAJA ↑↑↑ --}}


                            <hr>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <a href="{{ route('horarios.index') }}" class="btn btn-danger">Cancelar</a>
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


{{-- JavaScript para manejar la tabla de Materias y Profesores --}}
<script>
    // Agregar una nueva fila de materia y profesor
    document.getElementById('agregar-materia').addEventListener('click', function() {
        const tablaMaterias = document.getElementById('tabla-materias').querySelector('tbody');
        const nuevaFila = tablaMaterias.insertRow();

        // Dropdown de Materia
        let celdaMateria = nuevaFila.insertCell();
        let selectMateria = document.createElement('select');
        selectMateria.name = 'materias[]';
        selectMateria.className = 'form-control materia-dropdown';
        celdaMateria.appendChild(selectMateria);

        // Dropdown de Profesor
        let celdaProfesor = nuevaFila.insertCell();
        let selectProfesor = document.createElement('select');
        selectProfesor.name = 'profesor_id[]';
        selectProfesor.className = 'form-control profesor-dropdown';
        celdaProfesor.appendChild(selectProfesor);

        // Botón Eliminar
        let celdaAccion = nuevaFila.insertCell();
        let botonEliminar = document.createElement('button');
        botonEliminar.type = 'button';
        botonEliminar.className = 'btn btn-danger eliminar-fila';
        botonEliminar.textContent = 'Eliminar';
        celdaAccion.appendChild(botonEliminar);

        botonEliminar.addEventListener('click', () => nuevaFila.remove());

        cargarMaterias(false);
        cargarProfesores(false);
    });

    // Cargar materias dinámicamente
    function cargarMaterias(reset = true) {
        const pnf_id = document.getElementById('pnf_id').value;
        const dropdownsMaterias = document.querySelectorAll('.materia-dropdown');

        if (reset) dropdownsMaterias.forEach(dropdown => dropdown.innerHTML = '<option value=""></option>');

        if (pnf_id) {
            fetch(`/api/materias/${pnf_id}`)
                .then(response => response.json())
                .then(data => {
                    dropdownsMaterias.forEach(dropdown => {
                        data.materias.forEach(materia => {
                            if (!Array.from(dropdown.options).some(option => option.value === materia.id.toString())) {
                                let option = document.createElement('option');
                                option.value = materia.id;
                                option.textContent = materia.nombre;
                                dropdown.appendChild(option);
                            }
                        });
                    });
                })
                .catch(error => console.log('Error al cargar las materias:', error));
        }
    }

    // Cargar profesores dinámicamente
    function cargarProfesores(reset = true) {
        const dropdownsProfesores = document.querySelectorAll('.profesor-dropdown');
        const docentes = {!! json_encode($docentes) !!};

        if (reset) dropdownsProfesores.forEach(dropdown => dropdown.innerHTML = '<option value=""></option>');

        dropdownsProfesores.forEach(dropdown => {
            docentes.forEach(docente => {
                if (!Array.from(dropdown.options).some(option => option.value === docente.id.toString())) {
                    let option = document.createElement('option');
                    option.value = docente.id;
                    option.textContent = docente.nombre_apellido;
                    dropdown.appendChild(option);
                }
            });
        });
    }

    // Actualizar materias y profesores al cambiar el PNF
    document.getElementById('pnf_id').addEventListener('change', () => {
        cargarMaterias();
        cargarProfesores();
    });
</script>

{{-- JavaScript para manejar los horarios dinámicamente --}}
<script>
    document.getElementById('turno').addEventListener('change', function() {
        const turno = this.value;
        const tabla = document.getElementById('tabla-horarios').querySelector('tbody');
        tabla.innerHTML = '';

        let horas = {
            'Mañana': ['8:00 – 8:45', '8:45 – 9:30', '9:30 – 10:15', '10:15 – 11:00', '11:00 – 11:45', '11:45 – 12:30'],
            'Tarde': ['12:30 – 1:15', '1:15 – 2:00', '2:00 – 2:45', '2:45 – 3:30', '3:30 – 4:15', '4:15 – 5:00'],
            'Noche': ['5:00 – 5:30', '5:30 – 6:00', '6:00 – 6:30', '6:30 – 7:00', '7:00 – 7:30', '7:30 – 8:00']
        }[turno] || [];

        horas.forEach(hora => {
            let fila = tabla.insertRow();
            fila.insertCell().textContent = hora;

            ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'].forEach(dia => {
                let celdaDia = fila.insertCell();
                let input = document.createElement('select');
                input.name = `horarios[${dia}][${hora}]`;
                input.className = 'form-control materia-dropdown';
                input.innerHTML = '<option value=""></option>';
                celdaDia.appendChild(input);
            });
        });
    });
</script>
<script>
    // Detectar cambios en el horario y agregar la materia automáticamente a "Materias y Profesores"
document.getElementById('tabla-horarios').addEventListener('change', function (event) {
    if (event.target.tagName === 'SELECT' && event.target.classList.contains('materia-dropdown')) {
        const materiaId = event.target.value;
        const materiaNombre = event.target.options[event.target.selectedIndex].text;

        if (materiaId) {
            // Verificar si la materia ya está en la tabla de "Materias y Profesores"
            const tablaMaterias = document.getElementById('tabla-materias').getElementsByTagName('tbody')[0];
            let materiaExiste = false;

            tablaMaterias.querySelectorAll('.materia-dropdown').forEach(select => {
                if (select.value === materiaId) {
                    materiaExiste = true;
                }
            });

            // Si la materia no existe, agregarla
            if (!materiaExiste) {
                const nuevaFila = tablaMaterias.insertRow();

                // Columna 1: Dropdown de Materia
                let celdaMateria = nuevaFila.insertCell();
                let selectMateria = document.createElement('select');
                selectMateria.name = 'materias[]';
                selectMateria.className = 'form-control materia-dropdown';
                let optionMateria = document.createElement('option');
                optionMateria.value = materiaId;
                optionMateria.textContent = materiaNombre;
                selectMateria.appendChild(optionMateria);
                celdaMateria.appendChild(selectMateria);

                // Columna 2: Dropdown de Profesor
                let celdaProfesor = nuevaFila.insertCell();
                let selectProfesor = document.createElement('select');
                selectProfesor.name = 'profesor_id[]';
                selectProfesor.className = 'form-control profesor-dropdown';
                selectProfesor.innerHTML = '<option value=""></option>';
                celdaProfesor.appendChild(selectProfesor);

                // Columna 3: Botón Eliminar
                let celdaAccion = nuevaFila.insertCell();
                let botonEliminar = document.createElement('button');
                botonEliminar.type = 'button';
                botonEliminar.className = 'btn btn-danger eliminar-fila';
                botonEliminar.textContent = 'Eliminar';
                celdaAccion.appendChild(botonEliminar);

                // Eliminar fila al hacer clic en "Eliminar"
                botonEliminar.addEventListener('click', function () {
                    nuevaFila.remove();
                });

                // Cargar los profesores en el nuevo dropdown
                cargarProfesores(false);
            }
        }
    }
});

</script>
@endsection
