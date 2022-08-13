@extends('Plantillas.plantilla')
@section('titulo', 'Servicio')
@section('barra')
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <form action="{{ route('servicio.index2') }}" method="GET">
                    <div class="form-row">
                        <div class="col-sm-6 my-1">
                            <input type="search" class="form-control" value="{{ $texto }}" name="texto"
                                name="texto" placeholder="Buscar por nombre o apellido del cliente o técnico">
                        </div>
                        <div class="col-auto my-1">
                            <input type="submit" class="btn"
                                style="background-color:gray; border-color:black; color:white" value="Buscar">
                            <a href="{{ route('servicio.index') }}" class="btn my-8"
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

    <h1 class="">Listado de servicios técnicos</h1>
    <br><br>
    <div class="d-grid gap-2 d-md-block ">
        <a class="btn" style="background-color:rgb(65, 145, 126); border-color:black; color:white"
            href="{{ route('servicio.crear') }}"> <span class="glyphicon glyphicon-plus"></span> Agregar servicio </a>
    </div>

    <br>
    <div class="table-responsive">
        <table class="table table-bordered border-dark mt-3">
            <thead class="table table-striped table-hover">
                <tr class="info">
                    <th scope="col">N°</th>
                    <th scope="col">Técnico</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Fecha del servicio</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Cambiar estado</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($servicios as $servicio)
                    @if ($servicio->Estado == 'Sin realizar')
                        <tr class="active">
                            <th scope="row">{{ $servicio->id }}</th>
                            <td scope="col">{{ $servicio->personal->NombresDelEmpleado }}
                                {{ $servicio->personal->ApellidosDelEmpleado }}</td>
                            <td scope="col">{{ $servicio->clientes->NombresDelCliente }}
                                {{ $servicio->clientes->ApellidosDelCliente }}</td>

                            <td scope="col">{{ $servicio->FechaDeRealizacion }}</td>
                            <td scope="col">{{ $servicio->Estado }}</td>
                            <td> <a class="btn btn-success" style="border-color:black; color:white;"
                                    onclick="cambiarEstado({{ $servicio->id }})">
                                    <span class="glyphicon glyphicon-ok"></span>
                                    Realizado
                                </a>
                            </td>
                            <td>
                                <a class="btn" style="background-color:white; border-color:black; color:black"
                                    href="{{ route('servicio.mostrar', ['id' => $servicio->id]) }}">
                                    <span class="glyphicon glyphicon-eye-open"></span>
                                    Más detalles
                                </a>
                                <a class="btn" style="background-color:white; border-color:black; color:black"
                                    href="{{ route('servicio.edit', ['id' => $servicio->id]) }}">
                                    <span class="glyphicon glyphicon-edit"></span>
                                    Editar
                                </a>
                            </td>
                        </tr>
                    @endif
                @empty
                    <tr>
                        <td colspan="4"> No hay más servicios </td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>
            {{ $servicios->links() }}

        @endsection

        @push('alertas')
            <script>
                function cambiarEstado(id) {
                    var ruta = "/estado/" + id;
                    Swal.fire({
                        title: '¿Está seguro que el servicio técnico ya fue realizado?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Aceptar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {

                        if (result.isConfirmed) {
                            window.location = ruta;
                        }


                    })
                }
            </script>
        @endpush
