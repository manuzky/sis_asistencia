@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="card card-outline card-primary">
                            <div class="card-header text-center">
                              <a href="/" class="h1"><b>Control de </b>Asistencias</a>
                            </div>
                            <div class="card-body">
                              <p class="login-box-msg">Ingresa tus credenciales para <b>iniciar sesión</b></p>
                        
                              <form action="../../index3.html" method="post">
                                <div class="input-group mb-3">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Correo electrónico">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                  <div class="input-group-append">
                                    <div class="input-group-text">
                                      <span class="fas fa-envelope"></span>
                                    </div>
                                  </div>
                                </div>
                                <div class="input-group mb-3">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Contraseña">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div class="input-group-append">
                                    <div class="input-group-text">
                                      <span class="fas fa-lock"></span>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-8">
                                    <div class="icheck-primary">
                                      <input type="checkbox" id="remember">
                                      <label for="remember">
                                        Recordarme
                                      </label>
                                    </div>
                                  </div>
                                  <!-- /.col -->
                                  <div class="col-4">
                                    <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
                                  </div>
                                  <!-- /.col -->
                                </div>
                              </form>
                            </div>
                            <!-- /.card-body -->
                          </div>
                    </form>
                </div>

        </div>
    </div>
</div>
@endsection
