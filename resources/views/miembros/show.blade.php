@extends('layouts.admin')
@section('content')
    <div class="content" style="margin-left: 2%">
        <br>
        <div class="row">
            <div class="col-md-11">
                <div class="card card-primary shadow">
                    <div class="card-header">
                        <h3 class="card-title text-center">Datos del miembro registrado</h3>
                    </div>
                    
                    <div class="card-body" style="display: block;">
                    
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Nombre y apellido</label>
                                                <input type="text" name="nombre_apellido" value="{{$miembro->nombre_apellido}}" class="form-control" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Cédula</label>
                                                <input type="text" name="cedula" value="{{ number_format($miembro->cedula, 0, '.', '.') }}" class="form-control" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">E-mail</label>
                                                <input type="email" name="email" value="{{$miembro->email}}" class="form-control" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Fecha de nacimiento</label>
                                                <input type="date" name="fecha_nacimiento" value="{{$miembro->fecha_nacimiento}}" class="form-control" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Teléfono</label>
                                                <input type="text" name="telefono" value="{{ substr($miembro->telefono, 0, 4) . '-' . substr($miembro->telefono, 4, 3) . '.' . substr($miembro->telefono, 7) }}" class="form-control" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Genero</label>
                                                <select name="genero" id="" class="form-control" disabled>
                                                    @if($miembro->genero == 'MASCULINO')
                                                    <option value="MASCULINO">MASCULINO</option>
                                                    @else
                                                    <option value="FEMENINO">FEMENINO</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Cargo</label>
                                                @if(isset($cargos[$miembro->cargo]))
                                                    <input type="text" name="cargo" value="{{ $cargos[$miembro->cargo] }}" class="form-control" disabled>
                                                @else
                                                    <input type="text" name="cargo" value="Desarrollador" class="form-control" disabled>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="">Dirección</label>
                                                <input type="text" name="direccion" value="{{$miembro->direccion}}" class="form-control" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Fotografía</label>
                                        <br>
                                        @if($miembro->foto == '')
                                            @if($miembro->genero == 'MASCULINO')
                                                <center><img src="{{url('images/hombre.png')}}" width="90%"></center>
                                            @else
                                                <center><img src="{{url('images/mujer.png')}}" width="90%"></center>
                                            @endif
                                        @else
                                            <center><img src="{{asset('storage').'/'.$miembro->foto}}" width="90%"></center>
                                        @endif
                                    </div>
                                </div>
                            </div>
    
                            <hr>
    
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <a href="/miembros" class="btn btn-danger">Volver</a>
                                    </div>
                                </div>
                            </div>

                    </div>
                </div>  
            </div>
        </div>
    </div>
@endsection