@extends('Plantillas.plantilla')
@section('titulo', 'Cargos')
@section('barra')
<div class="container">
    <div class="row">
        <div class="col-xl-12">
            <form action="{{route('cargo.index2')}}" method="GET">
                <div class="form-row">
                    <div class="col-sm-6 my-1">
                        <input type="search" class="form-control" name="texto" value="{{$texto}}" name="texto" placeholder="Buscar por nombre del cargo">
                    </div>
                    <div class="col-auto my-1">
                        <input type="submit" class="btn" style="background-color:gray; border-color:black; color:white" value="Buscar">
                        <a href="{{ route('cargo.index') }}" class="btn my-8" style="background-color:gray; border-color:black; color:white">Borrar búsqueda</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('contenido')
@if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@if (session('mensaje'))
        <div class="alert alert-success">
            {{ session('mensaje') }}
        </div>
    @endif

    <br><br>
    <h1> Listado de cargos </h1>
    <br><br>

    <div class="d-grid gap-2 d-md-block">
        <a class="btn" style="background-color:rgb(65, 145, 126); border-color:black; color:white" href="{{route('cargo.crear')}}"> <span class="glyphicon glyphicon-plus"></span> Agregar cargo </a>
    </div>

        <br>

    {{ $cargos->links()}}

    <table class="table table-bordered border-dark mt-3">
        <thead class="thead-dark">
            <tr class="info">
                <th scope="col">N°</th>
                <th scope="col">Nombre del cargo</th>
                <th scope="col">Descripción del cargo</th>
                <th scope="col">Sueldo</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
        @forelse ($cargos as $cargo)
            <tr class="active">
                <th scope="row">{{ $cargo->id }}</th>
                <td scope="col">{{ $cargo->NombreDelCargo }}</td>
                <td scope="col">{{ $cargo->DescripciónDelCargo }}</td>
                <td scope="col">{{ $cargo->Sueldo }}</td>
                <td> <a class="btn" style="background-color:white; border-color:black; color:black" href="{{ route('cargo.edit',['id' => $cargo->id]) }}"> 
                    <span class="glyphicon glyphicon-edit"></span> Editar </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4"> No hay más cargos </td>
            </tr>
        @endforelse

        </tbody>
    </table>
@endsection