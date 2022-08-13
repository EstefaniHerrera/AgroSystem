@extends('plantillas.plantilla')
@section('titulo', 'Producto')
@section('contenido')

<h1> Detalles del producto {{$producto->NombreDelProducto}}
</h1>
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
<table class="table">
    <thead class="table-secondary">
        <tr>
            <th scope="col">Campos</th>
            <th scope="col">Información del producto</th>
        </tr>  
    </thead>
    <tbody>
        <tr>
            <th scope="row"> Categoría del producto </th>
            <td scope="col">{{ $categorias->NombreDeLaCategoría}} </td>
        </tr>
        <tr>
            <th scope="row">Nombre</th>
            <td scope="col">{{ $producto->NombreDelProducto }} </td>
        </tr>
        <tr>
            <th scope="row">Descripción</th>
            <td scope="col">{{ $producto->DescripciónDelProducto}} </td>
        </tr>
        <tr>
            <th scope="row">Impuesto</th>
            <td scope="col">{{ $producto->Impuesto}} </td>
        </tr>
    </tbody>
</table>

<a class="btn" href="{{route('producto.index')}}" style="background-color:gray; border-color:black; color:white"> 
    <span class="glyphicon glyphicon-arrow-left"></span> 
    Regresar
</a>   
@endsection