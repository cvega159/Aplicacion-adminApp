@extends('base')

@section('cont')

<h1>Ver departamento</h1>
@if(Session::has('message'))
    <div class="alert alert-{{ session()->get('type') }}" role="alert">
        {{ session()->get('message') }}
    </div>
@endif

<table class="table table-striped">
    <thead>
        <tr>
            <td>Atributo</td>
            <td>Valor</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Id</td> 
            <td>{{ $departamento->id }}</td> 
        </tr>
        <tr>
            <td>Nombre</td>
            <td>{{ $departamento->name }}</td> 
        </tr>
        <tr>
            <td>Sueldo minimo</td> 
            <td>{{ $departamento->location }}</td> 
        </tr>
        <tr>
            <td>Sueldo maximo</td> 
            <td>{{ $departamento->jefeDep }}</td> 
        </tr>
    </tbody>
</table>
<a href="{{ url('departamento') }}"><span class="btn btn-secondary"><i class="fas fa-backward"></i> Volver</span></a>
@endsection