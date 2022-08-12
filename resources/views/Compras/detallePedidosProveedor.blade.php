@extends('Plantillas.plantilla')
@section('titulo', 'Detalles Pedidos de proveedores')
@section('contenido')

    <h1> Detalle de pedidos de proveedores </h1>
    <br><br>

    <!-- PARA LOS ERRORES -->
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

    <div class="row" style="width: 87%">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="Proveedor"> Empresa proveedora </label>
                <input style="width: 100%" readonly type="text" class="form-control"
                    value="{{ $pedidos->proveedors->EmpresaProveedora }}">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label style="width: 100%" for="FechaPedidoCliente"> Fecha del pedido </label>
                <input style="width: 100%" readonly type="text" class="form-control"
                    value="{{ date('d-m-Y', strtotime($pedidos->FechaDelPedido)) }}">
            </div>
        </div>

    </div>


    <br><br>
    <div class="row" style="width: 100%">
        <div class="col-sm-16">
            <div class="table-responsive">
                <table class="table table-bordered border-dark mt-3">
                    <thead class="table table-striped table-hover">
                        <tr class="success">
                            <th scope="col">N°</th>
                            <th scope="col">Producto</th>
                            <th scope="col">Presentación</th>
                            <th scope="col">Cantidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detalles as $i => $details)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $details->Producto }}</td>
                                <td>{{ $details->Presentacion }}</td>
                                <td>{{ $details->Cantidad }}</td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>


    </div>

    <br>
    <a class="btn" href="{{ route('pedidosProveedor.index') }}"
        style="background-color:gray; border-color:black; color:white">
        <span class="glyphicon glyphicon-arrow-left"></span>
        Regresar
    </a>
    </form>
@endsection
