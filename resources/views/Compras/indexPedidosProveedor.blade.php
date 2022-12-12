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
                <form action="{{ route('pedidosProveedor.index') }}" method="GET">
                    <div class="form-row">
                        <div class="col-sm-6 my-1">
                            <input type="search" class="form-control" name="texto"
                                placeholder="Buscar por nombre del proveedor" value="{{ $proveedor }}">
                        </div>
                        <div class="col-auto my-1">
                            <input type="submit" class="btn"
                                style="background-color:gray; border-color:black; color:white" value="Buscar">
                            <a href="{{ route('pedidosProveedor.index') }}" class="btn my-8"
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
    <h1> Listado de pedidos de proveedores </h1>
    <br><br>

    <div class="d-grid gap-2 d-md-block ">
        <a class="btn" style="background-color:rgb(65, 145, 126); border-color:black; color:white"
            href="{{ route('pedidosProveedor.crear') }}">
            <span class="glyphicon glyphicon-plus"></span>
            Agregar pedido
        </a>
    </div>
    <br>
    <table class="table table-bordered border-dark mt-3">
        <thead class="table table-striped table-hover">
            <tr class="info">
                <th>Fecha del pedido</th>
                <th>Proveedor</th>
                <th>Estado</th>
                <th>Cambiar estado </th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pedidos as $pedido)
                <tr>
                    <td>{{ date('d-m-Y', strtotime($pedido->FechaDelPedido)) }}</td>
                    <td>{{ $pedido->proveedor->EmpresaProveedora }}</td>
                    <td>{{ $pedido->EstadoDelPedidoDelProveedor }}</td>
                    <td>
                        <a class="btn btn-success" style="border-color:black; color:white;"
                            onclick="cambiarEstadoP({{ $pedido->id }})">
                            <span class="glyphicon glyphicon-ok"></span>
                            Realizado </a>
                    </td>
                    <td>
                        <a class="btn" style="background-color:white; border-color:black; color:black"
                            href="{{ Route('pedidosProveedor.show', ['id' => $pedido->id]) }}">
                            <span class="glyphicon glyphicon-eye-open"></span>
                            Más detalles </a>
                        <a class="btn" style="background-color:white; border-color:black; color:black"
                            href="{{ route('pedidosProveedor.edit', ['id' => $pedido->id]) }}">
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
    {{ $pedidos->links() }}


@endsection
@push('alertas')
    <script>
        function cambiarEstadoP(id) {
            var ruta = "/estadoProveedor/" + id;
            Swal.fire({
                title: '¿Está seguro que el pedido ya fue realizado?',
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
            var ruta = "/destroyPro/" + id;
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
