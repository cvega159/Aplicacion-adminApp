@extends('base')

@section('cont')

<h1>Ver empleado</h1>
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
            <td>{{ $empleado->id }}</td> 
        </tr>
        <tr>
            <td>Nombre</td>
            <td>{{ $empleado->name }}</td> 
        </tr>
        <tr>
            <td>Apellidos</td> 
            <td>{{ $empleado->apellidos }}</td> 
        </tr>
        <tr>
            <td>Email</td> 
            <td>{{ $empleado->email }}</td> 
        </tr>
        <tr>
            <td>Telefono</td> 
            <td>{{ $empleado->telefono }}</td> 
        </tr>
        <tr>
            <td>Fecha contrato</td> 
            <td>{{ $empleado->fechacontrato }}</td> 
        </tr>
        <tr>
            <td>Id puesto</td> 
            <td>{{ $empleado->idpuesto }}</td> 
        </tr>
        <tr>
            <td>Id departamento</td> 
            <td>{{ $empleado->iddepartamento }}</td> 
        </tr>
    </tbody>
</table>
<a href="{{ url('empleado') }}"><span class="btn btn-secondary"><i class="fas fa-backward"></i> Volver</span></a>
@endsection