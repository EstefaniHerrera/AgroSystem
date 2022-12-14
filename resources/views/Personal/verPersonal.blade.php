@extends('plantillas.plantilla')
@section('titulo', 'Personal')
@section('contenido')

<h1> Detalles de {{$personal->NombresDelEmpleado}} {{$personal->ApellidosDelEmpleado}}
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
            <th scope="col">Información del empleado</th>
        </tr>  
    </thead>
    <tbody>
        <tr>
            <th scope="row"> Cargo </th>
            <td scope="col">{{ $personal->cargo->NombreDelCargo}} </td>
        </tr>
        <tr>
            <th scope="row"> Identidad </th>
            <td scope="col">{{ $personal->IdentidadDelEmpleado}} </td>
        </tr>
        <tr>
            <th scope="row">Nombres</th>
            <td scope="col">{{ $personal->NombresDelEmpleado }} </td>
        </tr>
        <tr>
            <th scope="row">Apellidos</th>
            <td scope="col">{{ $personal->ApellidosDelEmpleado }} </td>
        </tr>
        <tr>
            <th scope="row">Correo electrónico</th>
            <td scope="col">{{ $personal->CorreoElectrónico}} </td>
        </tr>
        <tr>
            <th scope="row">Teléfono</th>
            <td scope="col">{{ $personal->Teléfono }} </td>
        </tr>
        <tr>
            <th scope="row">Fecha De nacimiento</th>
            <td scope="col">{{\Carbon\Carbon::parse($personal->FechaDeNacimiento)->locale("es")->isoFormat("DD MMMM, YYYY")}}</td>
        </tr>
        <tr>
            <th scope="row">Fecha De ingreso</th>
            <td scope="col">{{\Carbon\Carbon::parse($personal->FechaDeIngreso)->locale("es")->isoFormat("DD MMMM, YYYY")}} </td>
        </tr>
        <tr>
            <th scope="row">Ciudad</th>
            <td scope="col">{{ $personal->Ciudad}} </td>
        </tr>
        <tr>
            <th scope="row">Dirección</th>
            <td scope="col">{{ $personal->Dirección}} </td>
        </tr>
    </tbody>
</table>

<a class="btn" style="background-color:gray; border-color:black; color:white" href="{{route('personal.index')}}"> 
    <span class="glyphicon glyphicon-arrow-left"></span>
    Regresar 
</a>
@endsection