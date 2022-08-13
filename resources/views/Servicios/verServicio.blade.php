@extends('plantillas.plantilla')
@section('titulo', 'Servicio')
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

<h1> Detalles del técnico  {{$servicio->personal->NombresDelEmpleado}} {{$servicio->personal->ApellidosDelEmpleado}}
</h1>
<br><br>
<table class="table">
    <thead class="table-secondary">
        <tr>
            <th scope="col">Campos</th>
            <th scope="col">Información del técnico</th>
        </tr>
    </thead>
        <tbody>
            <tr>
                <th scope="row">Técnico</th>
                <td scope="col">{{$cargo->NombreDelCargo}} </td>
            </tr>
            <tr>
                <th scope="row">Nombre del empleado</th>
                <td scope="col">{{ $servicio->personal->NombresDelEmpleado }} {{ $servicio->personal->ApellidosDelEmpleado }} </td>
            </tr>

            <tr>
                <th scope="row">Teléfono del técnico</th>
                <td scope="col">{{ $servicio->personal->Teléfono }} </td>
            </tr>
            <tr>
                <th scope="row">Fecha del servicio </th>
                <td scope="col">{{\Carbon\Carbon::parse($servicio->FechaDeRealizacion)->locale("es")->isoFormat("DD MMMM, YYYY")}} </td>
            </tr>
        </tbody>
    </table>
    <br>
    <h1> Detalles del cliente  {{$servicio->clientes->clientes }} {{ $servicio->clientes->ApellidosDelCliente}}
    </h1>
    <br><br>
    <table class="table">
        <thead class="table-secondary">
            <tr>
                <th scope="col">Campos</th>
                <th scope="col">Información del cliente</th>
            </tr>
        </thead>
            <tbody>
        <tr>
            <th scope="row">Cliente</th>
            <td scope="col">{{ $servicio->clientes->clientes }} {{ $servicio->clientes->ApellidosDelCliente }} </td>
        </tr>
        <tr>
            <th scope="row">Teléfono del cliente</th>
            <td scope="col">{{ $servicio->TeléfonoCliente }} </td>
        </tr>
        <tr>
            <th scope="row">Descripción</th>
            <td scope="col">{{ $servicio->DescripciónDelServicio}} </td>
        </tr>
        <tr>
            <th scope="row">Dirección</th>
            <td scope="col">{{ $servicio->Dirección}} </td>
        </tr>
    </tbody>
</table>

<a class="btn" href="{{route('servicio.index')}}" style="background-color:gray; border-color:black; color:white"> 
    <span class="glyphicon glyphicon-arrow-left"></span> 
    Regresar
</a>
@endsection