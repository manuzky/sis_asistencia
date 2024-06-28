@extends('layouts.admin')
@section('content')

<div class="content" style="margin: 1%">
    <br>
    <div class="row">
        @can('miembros')
        <div class="col-lg-3">
            <div class="small-box bg-primary">
                <div class="inner">
                    <?php $contador = 0 ?>
                    @foreach($miembros as $miembro)
                        <?php $contador = $contador + 1; ?>
                    @endforeach
                    <h3><?=$contador?></h3>
                    <p>Miembros ingresados</p>
                </div>
                <div class="icon">
                    <i class="bi bi-person-vcard-fill"></i>
                </div>
            <a href="{{url('miembros')}}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        @endcan

        {{-- @can('cargos')
        <div class="col-lg-3">
            <div class="small-box bg-warning">
                <div class="inner">
                    <?php $contador = 0 ?>
                    @foreach($cargos as $cargo)
                        <?php $contador = $contador + 1; ?>
                    @endforeach
                    <h3><?=$contador?></h3>
                    <p>Cargos ingresados</p>
                </div>
                <div class="icon">
                    <i class="bi bi-tags-fill"></i>
                </div>
            <a href="{{url('cargos')}}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        @endcan --}}

        @can('usuarios')
        <div class="col-lg-3">
            <div class="small-box bg-warning">
                <div class="inner">
                    <?php $contador = 0 ?>
                    @foreach($usuario as $usuario)
                        <?php $contador = $contador + 1; ?>
                    @endforeach
                    <h3><?=$contador?></h3>
                    <p>Usuarios ingresados</p>
                </div>
                <div class="icon">
                    <i class="bi bi-person-circle"></i>
                </div>
            <a href="{{url('usuarios')}}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        @endcan

        @can('asistencias')
        <div class="col-lg-3">
            <div class="small-box bg-success">
                <div class="inner">
                    <?php $contador_asistencias = 0 ?>
                    @foreach($asistencias as $asistencia)
                        <?php $contador_asistencias = $contador_asistencias + 1; ?>
                    @endforeach
                    <h3><?=$contador_asistencias?></h3>
                    <p>Asistencias ingresadas</p>
                </div>
                <div class="icon">
                    <i class="bi bi-calendar2-week"></i>
                </div>
            <a href="{{url('asistencias')}}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        @endcan

    </div>

    @can('asistencias')
    <!-- Formulario de registro de asistencia -->
    <div class="row">
        <div class="col-lg-6">
            <form action="{{ route('registrarAsistencia') }}" method="POST" id="contactForm">
                @csrf
                <div class="row input-group-newsletter">
                    <div class="col">
                        <input class="form-control" id="cedula" name="cedula" type="text" placeholder="Ingrese cédula" required />
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-primary" id="submitButton" type="submit">Registrar</button>
                    </div>
                </div>

                <div class="social-icons">
                    <div class="d-flex flex-row flex-lg-column justify-content-center align-items-center h-100 mt-3 mt-lg-0">
                        <div>
                            <label>
                                <input type="radio" name="tipo" value="entrada" checked />
                                <span>Entrada</span>
                            </label>
                            <label>
                                <input type="radio" name="tipo" value="salida" />
                                <span>Salida</span>
                            </label>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endcan
</div>


@if (session('success'))
    <script>
        Swal.fire({
            title: "¡Éxito!",
            text: "{{ session('success') }}",
            icon: "success",
            confirmButtonText: "Aceptar"
        });
    </script>
@endif

@if (session('error'))
    <script>
        Swal.fire({
            title: "¡Error!",
            text: "{{ session('error') }}",
            icon: "error",
            confirmButtonText: "Aceptar"
        });
    </script>
@endif


@endsection