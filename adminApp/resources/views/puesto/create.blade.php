@extends('base')

@section('cont')
    <h1>Crea puesto</h1>
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
    <form action="{{ url('puesto') }}" method="post">
    @csrf
    <input class="form-control" value="{{ old('name') }}" type="text" name="name" placeholder="Nombre del puesto" minlength="2" maxlength="150" required /><br>
    @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <input class="form-control" value="{{ old('min') }}" type="number" name="min" placeholder="Salario minimo" min="0.01" max="9999999.99" step="0.01" required /><br>
    @error('min')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <input class="form-control" value="{{ old('max') }}" type="number" name="max" placeholder="Salario maximo" min="0.01" max="9999999.99" step="0.01" required /><br>
    @error('max')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <input class="btn btn-primary" type="submit" value="Crear"/><br>
</form><br>
<a href="{{ url('puesto') }}"><span class="btn btn-secondary"><i class="fas fa-backward"></i> Volver</span></a>
@endsection