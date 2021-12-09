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
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <form id="form" action="" method="post">
            @method('delete')
            @csrf
            <input type="submit" class="btn btn-primary" value="Borrar puesto"/>
        </form>
      </div>
    </div>
  </div>
</div>

<h1>Puestos de trabajo</h1>

<a href="{{ url('puesto/create') }}"><span class="btn btn-primary">Crear un puesto</span></a><br>

<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Salario minimo</th>
            <th scope="col">Salario maximo</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($puestos as $puesto)
            <tr>
                <td>
                    {{ $puesto->id }}
                </td>
                <td>
                    {{ $puesto->name }}
                </td>
                <td>
                    {{ $puesto->min }}
                </td>
                <td>
                    {{ $puesto->max }}
                </td> 
                <td>
                    <a class="btn btn-primary" href="{{ url('puesto/' . $puesto->id) }}"><i class="fas fa-eye"></i></a>
                </td>
                <td>
                    <a class="btn btn-secondary" href="{{ url('puesto/' . $puesto->id . '/edit') }}"><i class="fas fa-edit"></i></a>
                </td>
                <td>
                    <a class="btn btn-danger" href="" data-toggle="modal" data-target="#modalDelete" 
                    onclick="deleteElement({{ $puesto->id }}, '{{ $puesto->name }}','puesto')"><i class="fas fa-trash-alt"></i> </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>    
@endsection

@section('js')
<script src="{{ url('assets/js/deleteElement.js') }}"></script>
@endsection
