@extends('Plantillas.plantilla')
@section('titulo', 'Precios')
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
    <br>

    <h1 class=""> Precios del producto: {{$nombre}}</h1>
    <br>
    <br>

    <table class="table table-bordered border-dark mt-3" >
        <thead class="table table-striped table-hover">
            <tr class="success">
                <th scope="col">N°</th>
                <th scope="col">Fecha de la compra</th>
                <th scope="col">Presentación</th>
                <th scope="col">Precio de compra</th>
            </tr>
        </thead>
        <tbody>
        @forelse ($precios as $i => $precio)
            <tr class="active">
                <th scope="row">{{ ($i+1) }}</th>
                <td scope="col">{{\Carbon\Carbon::parse($precio->FechaCompra)->locale("es")->isoFormat("DD MMMM, YYYY")}}</td>
                <td scope="col">{{ $precio->presentacion->informacion}}</td>
                <td scope="col">{{ $precio->Precio_compra }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4"> No hay compras </td>
            </tr>
        @endforelse

        </tbody>
    </table>
    <br>
    <a href="{{route('inventario.index')}}" class="btn" style="background-color:gray; border-color:black; color:white"> 
        <span class="glyphicon glyphicon-arrow-left"></span> 
        Regresar
    </a>   
@endsection