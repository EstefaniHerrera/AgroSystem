@extends('Plantillas.plantilla')

@section('titulo', 'Productos')
@section('barra')
<div class="container">
    <div class="row">
        <div class="col-xl-12">
            <form action="{{route('producto.index2')}}" method="GET">
                <div class="form-row">
                    <div class="col-sm-6 my-1">
                        <input type="search" class="form-control" value="{{$texto}}" name="texto" name="texto" placeholder="Buscar por nombre y categoría del producto">
                    </div>
                    <div class="col-auto my-1">
                        <input type="submit" class="btn" style="background-color:gray; border-color:black; color:white" value="Buscar">
                        <a href="{{ route('producto.index') }}" class="btn my-8" style="background-color:gray; border-color:black; color:white">Borrar búsqueda</a>
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
    <h1> Listado de productos </h1>
    <br><br>

    <div class="d-grid gap-2 d-md-block">
        <a class="btn" style="background-color:rgb(65, 145, 126); border-color:black; color:white" href="{{route('producto.crear')}}"><span class="glyphicon glyphicon-plus"></span> Agregar producto </a>
    </div>
    <br>
    <table class="table table-bordered border-dark">
        <thead class="table-dark">
            <tr class="info">
                <th scope="col">N°</th>
                <th scope="col">Nombre del producto</th>
                <th scope="col">Categoría</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
        @forelse ($productos as $producto)
            <tr class="active">
                <th scope="row">{{ $producto->id }}</th>
                <td scope="col">{{ $producto->NombreDelProducto}}</td>
                <td scope="col">{{ $producto->categorias->NombreDeLaCategoría}}</td>
                <td> 
                    <a class="btn" style="background-color:white; border-color:black; color:black" href="{{ route('producto.mostrar',['id' => $producto->id]) }}" > 
                        <span class="glyphicon glyphicon-eye-open"></span> 
                    Más detalles </a>
                </td> 
                <td> 
                    <a class="btn" style="background-color:white; border-color:black; color:black" href="{{ route('producto.edit',['id' => $producto->id]) }}"> 
                    <span class="glyphicon glyphicon-edit"></span>
                    Editar </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4"> No hay más productos </td>
            </tr>
        @endforelse

        </tbody>
    </table>
    {{ $productos->links()}}
    

@endsection