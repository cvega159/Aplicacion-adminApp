@extends('base')

@section('cont')
    <h1>Crea un empleado</h1>
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
    <form action="{{ url('empleado') }}" method="post">
    @csrf
    @method('post')
    <input class="form-control" value="{{ old('name') }}" type="text" name="name" placeholder="Nombre del empleado" minlength="2" maxlength="150" required /><br>
    @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <input class="form-control" value="{{ old('apellidos') }}" type="text" name="apellidos" placeholder="Apellidos" minlength="10" maxlength="250"required /><br>
    @error('apellidos')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <input class="form-control" value="{{ old('email') }}" type="text" name="email" placeholder="Email" minlength="10" maxlength="250"required /><br>
    @error('email')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <input class="form-control" value="{{ old('telefono') }}" type="number" name="telefono" placeholder="Telefono" minlength="9" maxlength="9"required /><br>
    @error('telefono')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <input class="form-control" value="{{ old('fechacontrato') }}" type="date" name="fechacontrato" placeholder="Fecha de contrato" minlength="10" maxlength="250"required /><br>
    @error('fechacontrato')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <select class="form-control" name="idpuesto" required>
        <option  selected disabled value="">&nbsp;</option>
        @foreach ($puestos as $puesto)
            <option  value="{{ $puesto -> id }}">{{$puesto -> name }}</option>
        @endforeach
    </select><br>
    <select class="form-control" name="iddepartamento" required>
        <option  selected disabled value="">&nbsp;</option>
        @foreach ($departamentos as $departamento)
            <option  value="{{ $departamento -> id }}">{{$departamento -> name }}</option>
        @endforeach
    </select><br>
    <input class="btn btn-primary" type="submit" value="Crear"/>
</form>
<a href="{{ url('empleado') }}"><span class="btn btn-secondary"><i class="fas fa-backward"></i> Volver</span></a>
@endsection