@extends('base')

@section('cont')

<h1>Edita el puesto</h1>
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
<form action="{{ url('puesto/' . $puesto->id) }}" method="post">
    @csrf
    @method('put')
    <input class="form-control" value="{{ old('name', $puesto->name) }}" type="text" name="name" placeholder="Nombre del puesto" minlength="2" maxlength="150" required /><br>
    <input class="form-control" value="{{ old('min', $puesto->min) }}" type="number" name="min" placeholder="Salario minimo" min="0.01" max="9999999.99" step="0.01" required /><br>
    <input class="form-control" value="{{ old('max', $puesto->max) }}" type="number" name="max" placeholder="Salario maximo" min="0.01" max="9999999.99" step="0.01" required /><br>
    <input class="btn btn-primary" type="submit" value="Edit"/>
</form><br>
<a href="{{ url('puesto') }}"><span class="btn btn-secondary"><i class="fas fa-backward"></i> Volver</span></a>

@endsection