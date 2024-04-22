@extends('layouts.admin')
@section('content')
    <div class="content" style="margin-left: 2%">
        <h1>Editar datos del miembro</h1>
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
                        <form action="{{url('/miembros', $miembro->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            {{method_field('PATCH')}}
                            <div class="row">
                                <div class="col-md-9">
                                    <h6 style="color: red">Los campos con (<b>*</b>) son obligatorios</h6>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Nombre y apellido</label><b style="color:red"> *</b>
                                                <input type="text" name="nombre_apellido" value="{{$miembro->nombre_apellido}}" class="form-control" placeholder="Nombre y apellido">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Cédula</label><b style="color:red"> *</b>
                                                <input type="text" name="cedula" value="{{$miembro->cedula}}" class="form-control" placeholder="Cédula">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Email</label><b style="color:red"> *</b>
                                                <input type="email" name="email" value="{{$miembro->email}}" class="form-control" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Fecha de nacimiento</label><b style="color:red"> *</b>
                                                <div>
                                                    <div class="input-group date" id="datepicker">
                                                        <input type="text" name="fecha_nacimiento" value="{{$miembro->fecha_nacimiento}}" class="form-control" placeholder="Fecha de nacimiento" required>
                                                        <span class="input-group-append">
                                                            <span class="input-group-text bg-white">
                                                                <i class="fa fa-calendar"></i>
                                                            </span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Teléfono</label>
                                                <input type="number" name="telefono" value="{{$miembro->telefono}}" placeholder="Teléfono" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Genero</label><b style="color:red"> *</b>
                                                <select name="genero" id="" class="form-control">
                                                    @if($miembro->genero == 'MASCULINO')
                                                        <option value="MASCULINO">MASCULINO</option>
                                                        <option value="FEMENINO">FEMENINO</option>
                                                    @else
                                                        <option value="FEMENINO">FEMENINO</option>
                                                        <option value="MASCULINO">MASCULINO</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="cargo">Cargo</label><b style="color:red"> *</b>
                                                <select name="cargo" id="cargo" class="form-control" required>
                                                    <option value="">-- SELECCIONE EL CARGO --</option>
                                                    @foreach($cargos as $id => $nombre_cargo)
                                                        <option value="{{ $id }}" @if($miembro->cargo_id == $id) selected @endif>{{ $nombre_cargo }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="">Dirección</label>
                                                <input type="text" name="direccion" value="{{$miembro->direccion}}" placeholder="Dirección" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Fotografía</label>
                                        <input type="file" id="file" name="foto" class="form-control">
                                        <br>
                                        <center>
                                            <output id="list">
                                                @if($miembro->foto == '')
                                                    @if($miembro->genero == 'MASCULINO')
                                                        <center><img src="{{url('images/hombre.png')}}" width="90%"></center>
                                                    @else
                                                        <center><img src="{{url('images/mujer.png')}}" width="90%"></center>
                                                    @endif
                                                @else
                                                    <center><img src="{{asset('storage').'/'.$miembro->foto}}" width="90%"></center>
                                                @endif
                                            </output>
                                        </center>
                                        <script>
                                            function archivo(evt){
                                                var files = evt.target.files;
                                                //obtenemos la imagen del campo "file".
                                                for (var i=0, f; f = files[i]; i++){
                                                    //solo admitimos imagenes.
                                                    if (!f.type.match('image.*')){
                                                        continue;
                                                    }
                                                    var reader = new FileReader();
                                                    reader.onload = (function (theFile){
                                                        return function (e){
                                                            //insertamos la imagen
                                                            document.getElementById("list").innerHTML = ['<img class="thumb thumbnail" src="',e.target.result,'"width="50%" title="', escape(theFile.name),'"/>'].join('');
                                                        };
                                                    }) (f);
                                                    reader.readAsDataURL(f);
                                                }
                                            }
                                            document.getElementById('file').addEventListener('change',archivo, false);
                                        </script>
                                    </div>
                                </div>
                            </div>
    
                            <hr>
    
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <a href="{{url('miembros')}}" class="btn btn-danger">Cancelar</a>
                                        <button type="submit" class="btn btn-success">Actualizar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>  
            </div>
        </div>
    </div>

{{-- SCRIPTS --}}
<div>
    {{-- DATEPICKER --}}
    <script type="text/javascript">
        $(function() {
            $('#datepicker').datepicker({
                language: 'es' // Establecer el idioma en español
            });
        });
    </script>

    {{-- CARGAR Y MOSTRAR LA IMAGEN --}}
    <script>
        // Función para formatear la fecha en el formato DD-MM-YYYY
        function formatDate(dateString) {
            var dateParts = dateString.split("-");
            // Reorganiza los componentes de la fecha y agrega ceros iniciales si es necesario
            var formattedDate = dateParts[2] + "/" + dateParts[1].padStart(2, '0') + "/" + dateParts[0];
            return formattedDate;
        }
    
        // Ejecutar cuando el DOM esté listo
        document.addEventListener("DOMContentLoaded", function() {
            // Obtener el campo de fecha de nacimiento
            var fechaNacimientoInput = document.querySelector('input[name="fecha_nacimiento"]');
            // Obtener el valor actual del campo de fecha de nacimiento
            var fechaNacimientoValue = fechaNacimientoInput.value;
            // Formatear la fecha en el formato deseado
            var formattedDate = formatDate(fechaNacimientoValue);
            // Establecer el valor formateado en el campo de fecha de nacimiento
            fechaNacimientoInput.value = formattedDate;
        });
    </script>
</div>
    
@endsection