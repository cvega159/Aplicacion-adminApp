@extends('base')

@section('cont')
@if(Session::has('message'))
    <div class="alert alert-{{ session()->get('type') }}" role="alert">
        {{ session()->get('message') }}
    </div>
@endif
<!-- Modal -->
<div class="modal" id="modalDelete" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">¿Estas seguro de que quieres borrar?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>¿Seguro que quieres borrar <span class="name" >XXX</span>?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelae</button>
        <form id="form" action="" method="post">
            @method('delete')
            @csrf
            <input type="submit" class="btn btn-primary" value="Borrar empleado"/>
        </form>
      </div>
    </div>
  </div>
</div>

<h1>Empleados</h1>

<a href="{{ url('empleado/create') }}"><span class="btn btn-primary">Crear un empleado</span></a><br>

<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Apellidos</th>
            <th scope="col">Email</th>
            <th scope="col">Telefono</th>
            <th scope="col">Fecha contrato</th>
            <th scope="col">Id puesto</th>
            <th scope="col">Id departamento</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($empleados as $empleado)
            <tr>
                <td>
                    {{ $empleado->id }}
                </td>
                <td>
                    {{ $empleado->name }}
                </td>
                <td>
                    {{ $empleado->apellidos }}
                </td>
                <td>
                    {{ $empleado->email }}
                </td> 
                <td>
                    {{ $empleado->telefono }}
                </td>
                <td>
                    {{ $empleado->fechacontrato }}
                </td>
                <td>
                    {{ $empleado->puesto->name }}
                </td>
                <td>
                    {{ $empleado->departamento->name }}
                </td>
                <td>
                    <a class="btn btn-primary" href="{{ url('empleado/' . $empleado->id) }}"><i class="fas fa-eye"></i></a>
                </td>
                <td>
                    <a class="btn btn-secondary" href="{{ url('empleado/' . $empleado->id . '/edit') }}"><i class="fas fa-edit"></i></a>
                </td>
                <td>
                    <a class="btn btn-danger" href="" data-toggle="modal" data-target="#modalDelete" 
                    onclick="deleteElement({{ $empleado->id }}, '{{ $empleado->name }}','empleado')"><i class="fas fa-trash-alt"></i></a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>    
@endsection

@section('js')
<script src="{{ url('assets/js/deleteElement.js') }}"></script>
@endsection
