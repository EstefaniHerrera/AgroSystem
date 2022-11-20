@extends('plantillas.plantilla')
@section('titulo', 'Gasto')
@section('contenido')

    <h1> Detalles del gasto {{ $gasto->nombre }}
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
                <th scope="col">Información del gasto</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">Responsable</th>
                <td scope="col">{{ $gasto->person->NombresDelEmpleado }} {{ $gasto->person->ApellidosDelEmpleado }}</td>
            </tr>
            <tr>
                <th scope="row"> Nombre </th>
                <td scope="col">{{ $gasto->nombre }} </td>
            </tr>
            <tr>
                <th scope="row"> Descripción </th>
                <td scope="col">{{ $gasto->descripcion }} </td>
            </tr>
            <tr>
                <th scope="row">Tipo de gasto</th>
                <td scope="col">{{ $gasto->tipo }} </td>
            </tr>
            <tr>
                <th scope="row">Fecha</th>
                <td scope="col">{{ \Carbon\Carbon::parse($gasto->fecha)->locale('es')->isoFormat('DD MMMM, YYYY') }}</td>
            </tr>
            <tr>
                <th scope="row">Total del gasto</th>
                <td scope="col">{{ $gasto->total }} </td>
            </tr>
        </tbody>
    </table>

    <a class="btn" style="background-color:gray; border-color:black; color:white" href="{{ route('gasto.index') }}">
        <span class="glyphicon glyphicon-arrow-left"></span>
        Regresar
    </a>
@endsection
