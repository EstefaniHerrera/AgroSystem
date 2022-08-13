@extends('Plantillas.plantilla')

@section('titulo', 'Proveedores')
@section('barra')
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <form action="{{ route('proveedor.index2') }}" method="GET">
                    <div class="form-row">
                        <div class="col-sm-6 my-1">
                            <input type="search" class="form-control" value="{{ $texto }}" name="texto"
                                placeholder="Buscar por nombre de la empresa o del encargad@"
                                title="Buscar por nombre de la empresa o del encargad@">
                        </div>
                        <div class="col-auto my-1">
                            <input type="submit" class="btn"
                                style="background-color:gray; border-color:black; color:white" value="Buscar">
                            <a href="{{ route('proveedor.index') }}" class="btn my-8"
                                style="background-color:gray; border-color:black; color:white">Borrar búsqueda</a>
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
    <h1 class=""> Listado de proveedores </h1>
    <br><br>
    <div class="d-grid gap-2 d-md-block ">
        <a class="btn" style="background-color:rgb(65, 145, 126); border-color:black; color:white"
            href="{{ route('proveedor.crear') }}"><span class="glyphicon glyphicon-plus"></span> Agregar proveedor </a>
    </div>
    <br>
    <div class="table-responsive">
        <table class="table table-bordered border-dark mt-3">
            <thead class="table table-striped table-hover">
                <tr class="info">
                    <th scope="col">N°</th>
                    <th scope="col">Empresa</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Encargado</th>
                    <th scope="col">Teléfono del encargado</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($proveedors as $proveedor)
                    <tr class="active">
                        <th scope="row">{{ $proveedor->id }}</th>
                        <td scope="col">{{ $proveedor->EmpresaProveedora }}</td>
                        <td scope="col">{{ $proveedor->TeléfonoDeLaEmpresa }}</td>
                        <td scope="col">{{ $proveedor->NombresDelEncargado }}</td>
                        <td scope="col">{{ $proveedor->TeléfonoDelEncargado }}</td>

                        <td> <a class="btn" style="background-color:white; border-color:black; color:black"
                                href="{{ route('proveedor.mostrar', ['id' => $proveedor->id]) }}">
                                <span class="glyphicon glyphicon-eye-open"></span> Más detalles </a>
                        </td>
                        <td> <a class="btn" style="background-color:white; border-color:black; color:black"
                                href="{{ route('proveedor.edit', ['id' => $proveedor->id]) }}">
                                <span class="glyphicon glyphicon-edit"></span>
                                Editar </a>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="4"> No hay más proveedores </td>
                    </tr>
                @endforelse

            </tbody>
        </table>
        <div class="table-responsive">
            {{ $proveedors->links() }}

        @endsection
