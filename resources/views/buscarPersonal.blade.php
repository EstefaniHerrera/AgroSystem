@extends('Plantillas.plantilla')

@section('titulo', 'Personal')
@section('barra')
<div class="container">
    <div class="row">
        <div class="col-xl-12">
            <form action="{{route('personal.index2')}}" method="GET">
                <div class="form-row">
                    <div class="col-sm-4 my-1">
                        <input type="search" class="form-control" name="texto" placeholder="Buscar">
                    </div>
                    <div class="col-auto my-1">
                        <input type="submit" class="btn btn-secondary" value="Buscar">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('contenido')
@if (session('mensaje'))
        <div class="alert alert-success">
            {{ session('mensaje') }}
        </div>
    @endif
    <br>

    
    
    <h1 class=""> Listado Del Personal </h1>
    <br>
    <div class="d-grid gap-2 d-md-block ">
        <a class="btn btn-success float-" href="{{route('personal.crear')}}"> Agregar Personal </a>
        <a class="btn btn-success float-end me-md-2" href=""> Regresar </a>
    </div>
      
        <br>
    
    {{ $personals->links()}}
    
    <table class="table table-bordered border-dark mt-3" >
        <thead class="table table-striped table-hover">
            <tr class="success">
                <th scope="col">N°</th>
                <th scope="col">Identidad</th>
                <th scope="col">Nombres</th>
                <th scope="col">Apellidos</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Fecha de Ingreso</th>
                <th scope="col">Estado</th>
                <th scope="col">Más Detalles</th>
                <th scope="col">Editar</th>
                <th scope="col">Cambiar Estado</th>
            </tr>  
        </thead>
        <tbody>
        @forelse ($personals as $personal)
            <tr class="active">
                <th scope="row">{{ $personal->id }}</th>
                <td scope="col">{{ $personal->IdentidadPersonal }}</td>
                <td scope="col">{{ $personal->NombrePersonal }}</td>
                <td scope="col">{{ $personal->ApellidoPersonal }}</td>
                <td scope="col">{{ $personal->Telefono}}</td>
                <td scope="col">{{ $personal->FechaIngreso}}</td>
                <td scope="col">
                    @if ($personal->EmpleadoActivo)
                        Activo
                    @else
                        Inactivo
                    @endif
                </td>
                
                <td> <a class="btn btn-success" href="{{ route('personal.mostrar',['id' => $personal->id]) }}" > Más Detalles </a></td>
                <td> <a class="btn btn-success" href="{{ route('personal.edit',['id' => $personal->id]) }}"> Editar </a></td>
                <td>
                    @if ($personal->EmpleadoActivo)
                        <a class="btn btn-danger" href="{{ route('status.update',['id' => $personal->id]) }}" onclick="return confirm('¿Está seguro que desea desactivar al empleado?')">Desactivar</a>
                    @else
                        <a class="btn btn-success" href="{{ route('status.update',['id' => $personal->id]) }}" onclick="return confirm('¿Esta seguro que desea activar al empleado?')">Activar</a>
                    @endif
                </td>

            </tr>
        @empty
            <tr>
                <td colspan="4"> No hay más empleados </td>
            </tr>    
        @endforelse

        </tbody>
    </table>
    
@endsection