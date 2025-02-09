<div class="row">
    <div class="form-group col-md-6">
        {!! Form::label('name', 'Nombre') !!}
        <label for="name" style="color: red;">*</label>
        {!! Form::text('name', isset($role) ? $role->name : null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del rol']) !!}
    </div>
    
    <div class="form-group col-md-6">
        {!! Form::label('description', 'Descripción') !!}
        <label for="description" style="color: red;">*</label>
        {!! Form::text('description', isset($role) ? $role->description : null, ['class' => 'form-control', 'placeholder' => 'Descripción del rol']) !!}
    </div>
</div>

<h2 class="h3">Lista de permisos</h2>

@foreach ($permissions as $permission)
    <div class="form-group d-flex align-items-center ml-4">
        <!-- Toggle Switch -->
        <div class="checkbox-wrapper-34">
            <input class='tgl tgl-ios' id='toggle-{{$permission->id}}' type='checkbox' name="permissions[]" value="{{ $permission->id }}"
                @if(isset($role) && $role->permissions->contains($permission->id)) checked @endif>
            <label class='tgl-btn' for='toggle-{{$permission->id}}'></label>
        </div>

        <!-- Frase al lado del toggle -->
        <span class="ml-2">{{ $permission->description }}</span>
    </div>
@endforeach
