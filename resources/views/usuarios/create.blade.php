@extends('layouts.admin')
@section('content')
    <div class="content" style="margin-left: 2%">
        <h1>Creación de un nuevo usuario</h1>

        <div class="row">
            <div class="col-md-9">
                <div class="card card-primary shadow">
                    <div class="card-header">
                        <h3 class="card-title text-center">Rellene los campos</h3>
                    </div>
                    <div class="card">        
                        <div class="card-body">
                            <form id="formulario-usuario" method="POST" action="{{ url('usuarios') }}">
                                @csrf



                                <div class="row mb-3">
                                    <label for="miembro_id" class="col-md-4 col-form-label text-md-end">Usuario</label>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select id="miembro_id" class="form-control @error('miembro_id') is-invalid @enderror" name="miembro_id" required>
                                                <option value="" disabled selected>Selecciona un miembro</option>
                                                @foreach($miembros as $miembro)
                                                    <option value="{{ $miembro->id }}" data-email="{{ $miembro->email }}">{{ $miembro->nombre_apellido }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                
                                        @error('miembro_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                
                                <div class="row mb-3">
                                    <label for="email" class="col-md-4 col-form-label text-md-end">Correo electronico</label>
                                
                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="" readonly required autocomplete="off">
                                        
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                
                                
        
                                <div class="row mb-3">
                                    <label for="password" class="col-md-4 col-form-label text-md-end">Contraseña</label>
        
                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
        
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="row mb-3">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Confirmar contraseña</label>
                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>
                                <div id="mensaje-contrasenas" style="color: red;"></div>
        
                                <div class="row mb-3">
                                    <div class="col-md-4 col-form-label text-md-end">
                                        {{ Form::label('roles', 'Roles y permisos') }}
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {{ Form::select('roles', ['' => '-- SIN ROL --'] + $roles->pluck('name', 'id')->toArray(), null, ['class' => 'form-control']) }}
                                            {!! $errors->first('roles', '<div class="invalid-feedback">:message</div>') !!}
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4 mb-3">
                                <a href="{{url('usuarios')}}" class="btn btn-danger">Cancelar</a>
                                <button type="submit" class="btn btn-primary">
                                    Registrar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>  
            </div>
        </div>
    </div>

{{-- SCRIPTS --}}
<div>
    {{-- FUNCIÓN PARA QUE LAS CONTRASEÑAS COINCIDAN --}}
    <script>
        function verificarContraseñas() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("password-confirm").value;
            var mensaje = document.getElementById("mensaje-contrasenas");
    
            if (password !== confirmPassword) {
                mensaje.innerText = "LAS CONTRASEÑAS NO SON IDENTICAS";
                mensaje.style.color = "red";
                return false; // Impedir el envío del formulario
            } else {
                mensaje.innerText = "";
                return true; // Permitir el envío del formulario
            }
        }
    
        // Agregar evento de cambio al formulario para verificar contraseñas antes del envío
        document.getElementById("formulario-usuario").addEventListener("submit", function(event) {
            if (!verificarContraseñas()) {
                event.preventDefault(); // Impedir el envío del formulario si las contraseñas no coinciden
            }
        });
    </script>

    {{-- MUESTRA EL CORREO ELECTRÓNICO AUTOMATICAMENTE --}}
    <script>
        document.getElementById('miembro_id').addEventListener('change', function() {
            // Obtener el valor del correo electrónico del miembro seleccionado
            var selectedMiembroId = this.value;
            var selectedMiembroOption = this.options[this.selectedIndex];
            var selectedMiembroEmail = selectedMiembroOption.dataset.email;
            
            // Actualizar el valor del campo de correo electrónico con el valor del miembro seleccionado
            document.getElementById('email').value = selectedMiembroEmail;
        });
    </script>
</div>

@endsection

