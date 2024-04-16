@extends('layouts.admin')
@section('content')
    <div class="content" style="margin-left: 2%">
        <h1>Creación de un nuevo miembro</h1>
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
                        <form action="{{url('/miembros')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Nombre y apellido</label><b style="color:red"> *</b>
                                                <input type="text" name="nombre_apellido" value="{{old('nombre_apellido')}}" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Cédula</label><b style="color:red"> *</b>
                                                <input type="number" name="cedula" value="{{old('cedula')}}" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">E-mail</label><b style="color:red"> *</b>
                                                <input type="email" name="email" value="{{old('email')}}" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Fecha de nacimiento</label><b style="color:red"> *</b>
                                                <div>
                                                    <div class="input-group date" id="datepicker">
                                                        <input type="text" name="fecha_nacimiento" value="{{old('fecha_nacimiento')}}" class="form-control" required>
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
                                                <input type="number" name="telefono" value="{{old('telefono')}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Genero</label><b style="color:red"> *</b>
                                                <select name="genero" value="{{old('genero')}}" class="form-control" required>
                                                    <option value="">--SELECCIONE EL GENERO--</option>
                                                    <option value="MASCULINO" @if(old('genero') == 'MASCULINO') selected @endif>MASCULINO</option>
                                                    <option value="FEMENINO" @if(old('genero') == 'FEMENINO') selected @endif>FEMENINO</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Cargo</label><b style="color:red"> *</b>
                                                <input type="text" name="cargo" value="{{old('cargo')}}" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="">Dirección</label>
                                                <input type="text" name="direccion" value="{{old('direccion')}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Fotografía</label>
                                        <input type="file" id="file" name="foto" class="form-control">
                                        <br>
                                        <center><output id="list"></output></center>
                                    </div>
                                </div>
                            </div>
    
                            <hr>
    
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <a href="{{url('miembros')}}" class="btn btn-danger">Cancelar</a>
                                        <button type="submit" class="btn btn-success">Guardar Registro</button>
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

<script type="text/javascript">
    $(function() {
        $('#datepicker').datepicker({
            language: 'es' // Establecer el idioma en español
        });
    });
</script>

@endsection