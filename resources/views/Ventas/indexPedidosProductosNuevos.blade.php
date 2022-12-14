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
                <form action="{{ route('pedidosClienteP.index') }}" method="GET">
                    <div class="form-row">
                        <div class="col-sm-6 my-1">
                            <input type="search" class="form-control" name="texto"
                                placeholder="Buscar por nombre del cliente" value="{{ $cliente }}">
                        </div>
                        <div class="col-auto my-1">
                            <input type="submit" class="btn"
                                style="background-color:gray; border-color:black; color:white" value="Buscar">
                            <a href="{{ route('pedidosClienteP.index') }}" class="btn my-8"
                                style="background-color:gray; border-color:black; color:white"> Borrar búsqueda</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('contenido')

    <br><br>
    <h1>Listado de pedidos de productos nuevos</h1>
    <br><br>

    <div class="d-grid gap-2 d-md-block ">
        <a class="btn" style="background-color:rgb(65, 145, 126); border-color:black; color:white"
            href="{{ route('pedidosClienteP.crear') }}">
            <span class="glyphicon glyphicon-plus"></span>
            Agregar pedido
        </a>
    </div>
    <br>
    <div class="table-responsive">
        <table class="table table-bordered border-dark mt-3">
            <thead class="table table-striped table-hover">
                <tr class="info">
                    <th>Fecha del pedido</th>
                    <th>Cliente</th>
                    <th>Estado</th>
                    <th> </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pedidos as $pedido)
                    <tr>
                        <td>{{ date('d-m-Y', strtotime($pedido->FechaDelPedido)) }}</td>
                        <td>{{ $pedido->cliente->NombresDelCliente }} {{ $pedido->cliente->ApellidosDelCliente }}</td>
                        <td>{{ $pedido->estado }}</td>
                        <td>
                            <a class="btn btn-danger" style="border-color:black; color:white;"
                                onclick="cambiarEstadoP({{ $pedido->id }})">
                                <span class="glyphicon glyphicon-remove"></span>
                                Eliminar
                            </a>
                            <a class="btn" style="background-color:white; border-color:black; color:black"
                                href="{{ Route('pedidosClienteP.show', ['id' => $pedido->id]) }}">
                                <span class="glyphicon glyphicon-eye-open"></span>
                                Más detalles
                            </a>
                            <a class="btn" style="background-color:white; border-color:black; color:black"
                                href="{{ route('pedidosClienteP.edit', ['id' => $pedido->id]) }}">
                                <span class="glyphicon glyphicon-edit"></span>
                                Editar</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td rowspan="4">No hay resultados</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $pedidos->links() }}
@endsection
@push('alertas')
    <script>
        function cambiarEstadoP(id) {
            var ruta = "/estadoPPN/" + id;
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
