@extends('Plantillas.plantilla')

@section('titulo', 'Clientes')
@section('barra')
<div class="container">
    <div class="row">
        <div class="col-xl-12">
            <form action="{{route('cliente.index2')}}" method="GET">
                <div class="form-row">
                    <div class="col-sm-6 my-1">
                        <input type="search" class="form-control" name="texto" placeholder="Buscar por identidad, nombre, apellido o lugar de procedencia"
                        title="Buscar por identidad, nombre, apellido o lugar de procedencia" value="{{$texto}}">
                    </div>
                    <div class="col-auto my-1">
                        <input type="submit" class="btn" style="background-color:gray; border-color:black; color:white" value="Buscar">
                        <a href="{{ route('cliente.index') }}" class="btn my-8" style="background-color:gray; border-color:black; color:white">Borrar búsqueda</a>
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
    <h1 class=""> Listado de clientes </h1>
    <br><br>
    <div class="d-grid gap-2 d-md-block ">
        <a class="btn" style="background-color:rgb(65, 145, 126); border-color:black; color:white" href="{{route('cliente.crear')}}"><span class="glyphicon glyphicon-plus"></span> Agregar cliente </a>
    </div>

        <br>

    <table class="table table-bordered border-dark mt-3" >
        <thead class="table table-striped table-hover">
            <tr class="info">
                <th scope="col">N° de identidad</th>
                <th scope="col">Nombre completo</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Lugar de procedencia</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
        @forelse ($clientes as $cliente)
            <tr class="active">
                <td scope="col">{{ $cliente->IdentidadDelCliente}}</td>
                <td scope="col">{{ $cliente->NombresDelCliente}} {{ $cliente->ApellidosDelCliente}}</td>
                <td scope="col">{{ $cliente->Telefono }}</td>
                <td scope="col">{{ $cliente->LugarDeProcedencia }}</td>
                <td> <a class="btn" style="background-color:white; border-color:black; color:black" href="{{ route('cliente.edit',['id' => $cliente->id]) }}">
                    <span class="glyphicon glyphicon-edit"></span>
                    Editar </a>
                </td>

            </tr>
        @empty
            <tr>
                <td colspan="4"> No hay más clientes </td>
            </tr>
        @endforelse

        </tbody>
    </table>
    {{ $clientes->links()}}

@endsection