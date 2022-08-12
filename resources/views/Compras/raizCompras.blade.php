@extends('Plantillas.plantilla')
@section('titulo', 'Compras')
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
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <form method="GET" action="{{ route('compras.reporte') }}">
                    <div class="form-row">
                        <div class="col-sm-3 my-1">
                            <label for="id">Proveedor</label>
                            <select class="select222" name="id" id="id">
                                @if (isset($id) && $id !=0)
                                    @foreach ($proveedores as $proveedor)
                                        @if ($proveedor->id == $id)
                                            <option style="display: none" value="{{ $proveedor['id'] }}">{{ $proveedor['EmpresaProveedora'] }}</option>
                                        @endif
                                    @endforeach
                                @else
                                    <option style="display: none" value="0">--Seleccione--</option>
                                @endif
                                @foreach ($proveedores as $proveedor)
                                    <option value="{{ $proveedor['id'] }}">{{ $proveedor['EmpresaProveedora'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <?php
                        $fecha_actual = date('d-m-Y');
                        ?>
                        <div class="col-sm-2 my-1">
                        <label for="id">Fecha desde</label>
                        <input style="width: 100%" type="date" class="form-control" name="FechaDesde" id="Fechadesde"
                            maxlength="40" value="{{$fechadesde}}" max="<?php echo date('Y-m-d', strtotime($fecha_actual)); ?>">
                        </div>
                        <div class="col-sm-2 my-1">
                            <label for="id">Fecha hasta</label>
                            <input style="width: 100%" type="date" class="form-control" name="FechaHasta" id="Fechahasta"
                            maxlength="40" value="{{$fechahasta}}" max="<?php echo date('Y-m-d', strtotime($fecha_actual)); ?>">
                        </div>

                    </div>
                    <br>
                    <input type="submit" class="btn my-8" style="background-color:gray; border-color:black; color:white" value="Buscar">
                    <a href="{{ route('compras.index') }}" class="btn my-8" style="background-color:gray; border-color:black; color:white"> Borrar búsqueda </a>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('contenido')
    @if (session('mensaje'))
        <div class="alert alert-success">
            {{ session('mensaje') }}
        </div>
    @endif

    <br><br>
    <h1 class=""> Listado de compras </h1>
    <br><br>
    <div class="d-grid gap-2 d-md-block ">
        <a class="btn" style="background-color:rgb(65, 145, 126); border-color:black; color:white" href="{{ route('compras.crear') }}">
            <span class="glyphicon glyphicon-plus"></span> 
            Agregar compra 
        </a>
        <a class="btn" style="background-color:rgb(65, 145, 126); border-color:black; color:white" href="{{ route('compras.pdf', ['anio1' => $fechadesde, 'anio2' =>
        $fechahasta, 'proveeforR' => $id]) }}"  target="blank"><span class="glyphicon glyphicon-print">
            </span> 
            Imprimir reporte 
        </a>
    </div>

    <br>
    <div class="table-responsive">
        <table class="table table-bordered border-dark mt-3">
            <thead class="table table-striped table-hover">
                <tr class="info">
                    <th scope="col">N°</th>
                    <th scope="col">Número de factura</th>
                    <th scope="col">Proveedor</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Subtotal (Lps.)</th>
                    <th scope="col">Impuesto (Lps.)</th>
                    <th scope="col">Total compra (Lps.)</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($compras as $compra)
                    <tr class="active">
                        <th scope="row">{{ $compra->id }}</th>
                        <td scope="col">{{ $compra->NumFactura }}</td>
                        <td scope="col">{{ $compra->proveedors->EmpresaProveedora }}</td>
                        <td scope="col">{{\Carbon\Carbon::parse($compra->FechaCompra)->locale("es")->isoFormat("DD MMMM, YYYY")}}</td>
                        <td scope="col">{{ $compra->TotalCompra }}</td>
                        <td scope="col">{{ $compra->TotalImpuesto }}</td>
                        <td scope="col">{{ $compra->TotalCompra + $compra->TotalImpuesto}}</td>

                        <td>
                            <a class="btn" style="background-color:white; border-color:black; color:black" href="{{ route('compras.mostrar', ['id' => $compra->id]) }}">
                                <span class="glyphicon glyphicon-eye-open"></span>
                                Ver <br> detalles
                            </a>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="4"> No hay compras </td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>
    {{ $compras->links() }}

@endsection
@push('alertas')
    <script>
        $(document).ready(function() {
            new TomSelect(".select222", {
                create: false,
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });
        });
    </script>
@endpush

