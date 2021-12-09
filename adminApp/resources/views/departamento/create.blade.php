@extends('base')

@section('cont')
    <h1>Crea departamento</h1>
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
    <form action="{{ url('departamento') }}" method="post">
    @csrf
    @method('post')
    <input class="form-control" value="{{ old('name') }}" type="text" name="name" placeholder="Nombre del puesto" minlength="2" maxlength="150" required /><br>
    @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <input class="form-control" value="{{ old('location') }}" type="text" name="location" placeholder="Localizacion" minlength="10" maxlength="250"required /><br>
    @error('location')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <select class="form-control" name="jefeDep">
        <option  selected disabled value="">&nbsp;</option>
        @foreach ($empleados as $empleado)
            <option  value="{{ $empleado -> id}}">{{$empleado -> name }}</option>
        @endforeach
    </select><br>
    <input class="btn btn-primary" type="submit" value="Create"/>
</form><br>
<a href="{{ url('departamento') }}"><span class="btn btn-secondary"><i class="fas fa-backward"></i> Volver</span></a>
@endsection