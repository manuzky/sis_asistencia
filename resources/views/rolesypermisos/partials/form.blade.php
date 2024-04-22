<div class="row">
    <div class="form-group col-md-6">
        {!! Form::label('name', 'Nombre') !!}
        <label for="name" style="color: red;">*</label>
        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del rol']) !!}
    </div>
    
    <div class="form-group col-md-6">
        {!! Form::label('description', 'Descripción') !!}
        <label for="description" style="color: red;">*</label>
        {!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => 'Descripción del rol']) !!}
    </div>
</div>


<h2 class="h3">Lista de permisos</h2>

@foreach ($permissions as $permission)
    <div>
        <label>
            {!! Form::checkbox('permissions[]', $permission->id, null, ['class' => 'mr-1']) !!}
            {{$permission->description}}
        </label>
    </div>
@endforeach