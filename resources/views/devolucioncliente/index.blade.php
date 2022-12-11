@extends('Plantillas.plantilla')
@section('titulo', 'Devolucion clientes')
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
                <form method="GET" action="{{ route('devolucioncliente.reporte') }}">
                    <div class="form-row">
                        <div style="width: 17%;float: left;">
                            <label for="id">Cliente</label>
                            <select class="select222" name="cliente" id="id">
                                @if (isset($clien) && $clien != 0)
                                    @foreach ($clientes as $cliente)
                                        @if ($cliente->id == $clien)
                                            <option style="display: none" value="{{ $cliente['id'] }}">
                                                {{ $cliente['NombresDelCliente'] }} {{ $cliente['ApellidosDelCliente'] }}
                                            </option>
                                        @endif
                                    @endforeach
                                @else
                                    <option style="display: none" value="0">--Seleccione--</option>
                                @endif
                                <option value="a">Consumidor final</option>
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente['id'] }}">{{ $cliente['NombresDelCliente'] }}
                                        {{ $cliente['ApellidosDelCliente'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div style="width: 17%;float: left;margin-left: 1%">
                            <label for="id">Empleado</label>
                            <select class="select2222" name="empleado" id="id">
                                @if (isset($empleado) && $empleado != 0)
                                    @foreach ($personal as $cliente)
                                        @if ($cliente->id == $empleado)
                                            <option style="display: none" value="{{ $cliente['id'] }}">
                                                {{ $cliente['NombresDelEmpleado'] }} {{ $cliente['ApellidosDelEmpleado'] }}
                                            </option>
                                        @endif
                                    @endforeach
                                @else
                                    <option style="display: none" value="0">--Seleccione--</option>
                                @endif
                                @foreach ($personal as $cliente)
                                    <option value="{{ $cliente['id'] }}">{{ $cliente['NombresDelEmpleado'] }}
                                        {{ $cliente['ApellidosDelEmpleado'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <?php
                        $fecha_actual = date('d-m-Y');
                        ?>
                        <div class="col-sm-2 my-1">
                            <label for="id">Fecha desde</label>
                            <input style="width: 100%" type="date" class="form-control" name="FechaDesde" id="Fechadesde"
                                maxlength="40" value="{{ $fechadesde }}" max="<?php echo date('Y-m-d', strtotime($fecha_actual)); ?>" min="<?php echo date('Y-m-d', strtotime('2022-01-01')); ?>">
                        </div>
                        <div class="col-sm-2 my-1">
                            <label for="id">Fecha hasta</label>
                            <input style="width: 100%" type="date" class="form-control" name="FechaHasta" id="Fechahasta"
                                maxlength="40" value="{{ $fechahasta }}" max="<?php echo date('Y-m-d', strtotime($fecha_actual)); ?>" min="<?php echo date('Y-m-d', strtotime('2022-01-01')); ?>">
                        </div>

                    </div>
                    <br>
                    <input type="submit" class="btn my-8" style="background-color:gray; border-color:black; color:white"
                        value="Buscar">
                    <a href="{{ route('devolucioncliente.index') }}" class="btn my-8"
                        style="background-color:gray; border-color:black; color:white">Borrar búsqueda</a>
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
    <h1 class=""> Listado de devoluciones </h1>
    <br><br>

    <div class="tabla1">
        <div class="table-responsive">
            <table class="table table-bordered border-dark mt-3">
                <thead class="table table-striped table-hover">
                    <tr class="info">
                        <th scope="col">N°</th>
                        <th scope="col">Número de factura</th>
                        <th scope="col">Empleado</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Fecha</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($ventas as $key =>$compre)
                        <tr class="active">
                            <th>{{ $key + 1 }}</th>
                            <td>{{ $compre->NumFactura }}</td>
                            <td>{{ $compre->persona->NombresDelEmpleado }} {{ $compre->persona->ApellidosDelEmpleado }}
                            </td>
                            @if ($compre->cliente_id == null)
                                <td scope="col">Consumidor final</td>
                            @else
                                <td scope="col">{{ $compre->clientes->NombresDelCliente }}
                                    {{ $compre->clientes->ApellidosDelCliente }}</td>
                            @endif
                            <td>{{ $compre->FechaDevolucion }}</td>
                            <td><a class="btn" style="background-color:white; border-color:black; color:black"
                                    href="{{ route('devolucioncliente.mostrar', ['id' => $compre->id]) }}">
                                    <span class="glyphicon glyphicon-eye-open"></span>
                                    Ver detalles
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4"> No hay devoluciones </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
        {{ $ventas->links() }}
    </div>
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

        $(document).ready(function() {
            new TomSelect(".select2222", {
                create: false,
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });
        });
    </script>
@endpush
