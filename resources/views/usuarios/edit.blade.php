@extends('layouts.admin')
@section('content')
    <div class="content" style="margin-left: 2%">
        <h1>Actualización del usuario</h1>

        <div class="row">
            <div class="col-md-9">
                <div class="card card-primary shadow">
                    <div class="card-header">
                        <h3 class="card-title text-center">Modifique los campos</h3>
                    </div>
                    <div class="card">        
                        <div class="card-body">
                            <form method="POST" action="{{ url('usuarios', $usuario->id) }}">
                                @csrf
                                {{method_field('PATCH')}}

                                
                                <div class="row mb-3">
                                    <label for="miembro_id" class="col-md-4 col-form-label text-md-end">Usuario</label>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select id="miembro_id" class="form-control" name="miembro_id" required onchange="actualizarDatosUsuario()">
                                                @foreach($miembros as $miembro)
                                                    <option value="{{ $miembro->id }}" data-email="{{ $miembro->email }}" data-nombre-usuario="{{ $miembro->nombre_usuario }}" {{ $usuario->miembro_id == $miembro->id ? 'selected' : '' }}>
                                                        {{ $miembro->nombre_apellido }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                
                                <div class="row mb-3">
                                    <label for="email" class="col-md-4 col-form-label text-md-end">Correo electrónico</label>
                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ $usuario->email }}" readonly required autocomplete="off">
                                    </div>
                                </div>
                                
        
                                <div class="row mb-3">
                                    <label for="password" class="col-md-4 col-form-label text-md-end">Nueva contraseña</label>
        
                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  >
        
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    {!! Form::model($usuario, ['route' => ['usuarios.update', $usuario], 'method' => 'put']) !!}
                                    <div class="col-md-4 col-form-label text-md-end">
                                        {{ Form::label('roles', 'Roles y permisos') }}
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {{ Form::select('roles', ['' => '-- SIN ROL --'] + $roles->pluck('name', 'id')->toArray(), null, ['class' => 'form-control' . ($errors->has('roles') ? ' is-invalid' : '')]) }}
                                            {!! $errors->first('roles', '<div class="invalid-feedback">:message</div>') !!}
                                        </div>
                                    </div>
                                </div>
        
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4 mb-3">
                                <a href="{{url('usuarios')}}" class="btn btn-danger">Cancelar</a>
                                <button type="submit" class="btn btn-success">
                                    Actualizar
                                </button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </form>
                </div>  
            </div>
        </div>
    </div>

<script>
    function actualizarDatosUsuario() {
        var selectedUsuario = document.getElementById('miembro_id');
        var selectedUsuarioEmail = selectedUsuario.options[selectedUsuario.selectedIndex].getAttribute('data-email');
        var selectedUsuarioNombre = selectedUsuario.options[selectedUsuario.selectedIndex].getAttribute('data-nombre-usuario');

        document.getElementById('email').value = selectedUsuarioEmail;
        document.getElementById('nombre_usuario').value = selectedUsuarioNombre; // Actualizar el nombre de usuario
    }
</script>

@endsection

