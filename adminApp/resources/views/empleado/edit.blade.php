@extends('base')

@section('cont')

<h1>Edita el empleado</h1>
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
<form action="{{ url('empleado/' . $empleado->id) }}" method="post">
    @csrf
    @method('put')
    <input class="form-control" value="{{ old('name', $empleado->name) }}" type="text" name="name" placeholder="Nombre del empleado" minlength="2" maxlength="150" required /><br>
    <input class="form-control" value="{{ old('apellidos', $empleado->apellidos) }}" type="text" name="apellidos" placeholder="Apellidos del empleado" minlength="2" maxlength="250" required /><br>
    <input class="form-control" value="{{ old('email', $empleado->email) }}" type="text" name="email" placeholder="Email" minlength="2" maxlength="150" required /><br>
    <input class="form-control" value="{{ old('telefono', $empleado->telefono) }}" type="number" name="telefono" placeholder="Telefono" minlength="9" maxlength="9" /><br>
    <input class="form-control" value="{{ old('fechacontrato', $empleado->fechacontrato) }}" type="date" name="fechacontrato" placeholder="Fecha de contrato" required /><br>
    <select class="form-control" name="idpuesto" required>
        @foreach ($puestos as $puesto)
        @if($puesto->id==$empleado->idpuesto)
            <option value="{{$puesto->id}}" selected>{{ $puesto->name}}</option>
        @else
         <option value="{{$puesto->id}}">{{ $puesto->name}}</option>
         @endif
        @endforeach
    </select><br>
    <select class="form-control" name="iddepartamento" required>
        @foreach ($departamentos as $departamento)
        @if($departamento->id==$empleado->idpuesto)
            <option value="{{$departamento->id}}" selected>{{ $departamento->name}}</option>
        @else
            <option value="{{$departamento->id}}">{{ $departamento->name}}</option>
        @endif
        @endforeach
    </select><br>
    <input class="btn btn-primary" type="submit" value="Editar"/>
</form><br>
<a href="{{ url('empleado') }}"><span class="btn btn-secondary"><i class="fas fa-backward"></i> Volver</span></a>

@endsection