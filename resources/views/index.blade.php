@extends('layouts.admin')
@section('content')
    <div class="content" style="margin: 2%">
        <h1>Página principal</h1>
        <br>
        <div class="row">
            <div class="col-lg-3">
                <div class="small-box bg-info">
                    <div class="inner">
                            <?php $contador = 0 ?>
                            @foreach($miembros as $miembro)
                                <?php $contador = $contador + 1; ?>
                            @endforeach
                        <h3><?=$contador?></h3>
                        <p>Miembros</p>
                    </div>
                    <div class="icon">
                        <i class="bi bi-file-earmark-person"></i>
                    </div>
                <a href="{{url('miembros')}}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="small-box bg-success">
                    <div class="inner">
                        <?php $contador = 0 ?>
                        @foreach($cargos as $cargo)
                            <?php $contador = $contador + 1; ?>
                        @endforeach
                        <h3><?=$contador?></h3>
                        <p>Cargos</p>
                    </div>
                    <div class="icon">
                        <i class="bi bi-person-lines-fill"></i>
                    </div>
                <a href="{{url('cargos')}}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="small-box bg-warning">
                    <div class="inner">
                            <?php $contador = 0 ?>
                            @foreach($usuario as $usuario)
                                <?php $contador = $contador + 1; ?>
                            @endforeach
                        <h3><?=$contador?></h3>
                        <p>Usuarios</p>
                    </div>
                    <div class="icon">
                        <i class="bi bi-person-circle"></i>
                    </div>
                <a href="{{url('usuarios')}}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="small-box bg-primary">
                    <div class="inner">
                            <?php $contador_asistencias = 0 ?>
                            @foreach($asistencias as $asistencia)
                                <?php $contador_asistencias = $contador_asistencias + 1; ?>
                            @endforeach
                        <h3><?=$contador_asistencias?></h3>
                        <p>Asistencias</p>
                    </div>
                    <div class="icon">
                        <i class="bi bi-calendar2-week"></i>
                    </div>
                <a href="{{url('asistencias')}}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

        </div>
    </div>
@endsection