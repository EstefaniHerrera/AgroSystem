@extends('Plantillas.plantilla')
@section('titulo', 'Listado de pedidos')
@section('barra')
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

    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <form action="{{ route('pedidosCliente.index') }}" method="GET">
                    <div class="form-row">
                        <div class="col-sm-6 my-1">
                            <input type="search" class="form-control" name="texto"
                                placeholder="Buscar por nombre del cliente" value="{{ $cliente }}">
                        </div>
                        <div class="col-auto my-1">
                            <input type="submit" class="btn"
                                style="background-color:gray; border-color:black; color:white" value="Buscar">
                            <a href="{{ route('pedidosCliente.index') }}" class="btn my-8"
                                style="background-color:gray; border-color:black; color:white">Borrar búsqueda</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('contenido')

    <br><br>
    <h1>Listado de pedidos de clientes</h1>
    <br><br>

    <div class="d-grid gap-2 d-md-block ">

        <a class="btn" style="background-color:rgb(65, 145, 126); border-color:black; color:white"
            href="{{ route('pedidosCliente.crear',['idCliente' => 0]) }}"><span class="glyphicon glyphicon-plus"></span> Agregar pedido </a>
    </div>
    <br>
    <div class="table-responsive">
        <table class="table table-bordered border-dark mt-3">
            <thead class="table table-striped table-hover">
                <tr class="info">
                    <th>Fecha del pedido</th>
                    <th>Cliente</th>
                    <th>Estado</th>
                    <th>Cambiar estado</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pedidos as $pedido)
                    <tr>
                        @if ($pedido->EstadoDelPedido == 'No reclamado')
                            <td>{{ date('d-m-Y', strtotime($pedido->FechaDelPedido)) }}</td>
                            <td>{{ $pedido->NombresDelCliente }} {{ $pedido->ApellidosDelCliente }}</td>
                            <td>{{ $pedido->EstadoDelPedido }}</td>
                            <td>
                                <a class="btn btn-success" style="border-color:black; color:white;"
                                    onclick="cambiarEstado({{ $pedido->id }})">
                                    <span class=" glyphicon glyphicon-file"></span>
                                    Facturar pedido
                                </a>
                                <a class="btn btn-danger" style="border-color:black; color:white;"
                                    onclick="eliminar({{ $pedido->id }})">
                                    <span class=" glyphicon glyphicon-remove"></span>
                                    Eliminar
                                </a>
                            </td>
                            <td>
                                <a class="btn" style="background-color:white; border-color:black; color:black"
                                    href="{{ Route('pedidosCliente.show', ['id' => $pedido->id]) }}">
                                    <span class="glyphicon glyphicon-eye-open"></span>
                                    Detalles
                                </a>
                                <a class="btn" style="background-color:white; border-color:black; color:black"
                                    href="{{ route('pedidosClientes.edit', ['id' => $pedido->id]) }}">
                                    <span class="glyphicon glyphicon-edit"></span>
                                    Editar
                                </a>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td rowspan="4">No hay resultados</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection
@push('alertas')
    <script>
        function cambiarEstado(id) {
            var ruta = "/estadoP/" + id;
            Swal.fire({
                title: '¿Está seguro que desea facturar y eliminar el pedido?',
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

        function eliminar(id) {
            var ruta = "/destroy/" + id;
            Swal.fire({
                title: '¿Está seguro que desea eliminar el pedido?',
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
