@extends('base')

@section('cont')

<h1>Edita el departamento</h1>
    @if(Session::has('message'))
    <div class="alert alert-{{ session()->get('type') }}" role="alert">
        {{ session()->get('message') }}
    </div>
    @endif
    @if ($errors->any())
     <div class="alert alert-danger">
     <ul>
     @foreach ($errors->all() as $error)
     <li>{{ $error }}</li>
     @endforeach
     </ul>
     </div>
    @endif
<form action="{{ url('departamento/' . $departamento->id) }}" method="post">
    @csrf
    @method('put')
    <input class="form-control" value="{{ old('name', $departamento->name) }}" type="text" name="name" placeholder="Nombre del puesto" minlength="2" maxlength="150" required /><br>
    <input class="form-control" value="{{ old('location', $departamento->location) }}" type="text" name="location" placeholder="Localizacion" required /><br>
    <select class="form-control" name="jefeDep" required >
        @foreach ($empleados as $empleado)
        @if($empleado->id==$departamento->jefeDep)
            <option value="{{$empleado->id}}" selected>{{ $empleado->name}}</option>
        @else
         <option value="{{$empleado->id}}">{{ $empleado->name}}</option>
         @endif
        @endforeach
    </select><br>
    <input class="btn btn-primary" type="submit" value="Edit"/>
</form><br>
<a href="{{ url('departamento') }}"><span class="btn btn-secondary"><i class="fas fa-backward"></i> Volver</span></a>

@endsection