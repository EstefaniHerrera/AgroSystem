@extends('Plantillas.plantilla')
@section('titulo', 'Categorías')
@section('barra')
<div class="container">
    <div class="row">
        <div class="col-xl-12">
            <form action="{{route('categoria.index2')}}" method="GET">
                <div class="form-row">
                    <div class="col-sm-6 my-1">
                        <input type="search" class="form-control" name="texto" placeholder="Buscar por categorías" value="{{$texto}}">
                    </div>
                    <div class="col-auto my-1">
                        <input type="submit" class="btn" style="background-color:gray; border-color:black; color:white" value="Buscar">
                        <a href="{{ route('categoria.index') }}" class="btn my-8" style="background-color:gray; border-color:black; color:white">Borrar búsqueda</a>
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

    <br><br>
    <h1 class=""> Listado de categorías </h1>
    <br><br>
    <div class="d-grid gap-2 d-md-block ">
        <a class="btn" style="background-color:rgb(65, 145, 126); border-color:black; color:white" href="{{route('categoria.crear')}}"><span class="glyphicon glyphicon-plus"></span> Agregar categoría </a>
    </div>

        <br>
    <table class="table table-bordered border-dark mt-3" >
        <thead class="table table-striped table-hover">
            <tr class="info">
                <th scope="col">Categoría</th>
                <th scope="col">Descripción</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
        @forelse ($categorias as $categoria)
            <tr class="active">
                
                <td scope="col">{{ $categoria->NombreDeLaCategoría}}</td>
                <td scope="col">{{ $categoria->DescripciónDeLaCategoría}}</td>

                <td> <a class="btn" style="background-color:white; border-color:black; color:black" href="{{ route('categoria.edit',['id' => $categoria->id]) }}"> 
                    <span class="glyphicon glyphicon-edit"></span>
                    Editar </a>
                </td>

            </tr>
        @empty
            <tr>
                <td colspan="4"> No hay más categorías </td>
            </tr>
        @endforelse

        </tbody>
    </table>
    {{ $categorias->links()}}

@endsection