<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv='X-UA-Compatible' content='ie=edge'>
    <title>Document</title>
    <style>
        h2 {
            -webkit-user-select: none !important;
            -moz-user-select: none !important;
            -ms-user-select: none !important;
            user-select: none !important;
            color: rgb(00, 00, 00);
            font-family: cursive;
            text-shadow: 0px 370px 1.5px rgb(0, 0, 0);
            text-align: center;
        }

    </style>
    <link rel="stylesheet" href="css/bootstrap.min.css">

</head>

<body>
    <h2>Reporte De Ventas</h2>
    @if ($cliente != 0)
        <h4>Cliente: {{$n_c}}</h4>
    @endif
    @if ($empleado != 0)
        <h4>Empleado: {{$n_e}}</h4>
    @endif
    @if ($fechadesde != 0 && $fechahasta != 0)
        <h5>Desde {{ $fechadesde }} hasta {{ $fechahasta }} </h5>
    @else
    @if ($fechadesde != 0)
        <h5>Desde {{ $fechadesde }}</h5>
    @endif
    @if ($fechahasta != 0)
        <h5>hasta {{ $fechahasta }} </h5>
    @endif
    @endif
    


    <table class='table table-bordered border-dark mt-3'>
        <thead class='table table-striped table-hover'>
            <tr class='success'>
                <th scope="col">Número de factura</th>
                <th scope="col">Empleado</th>
                <th scope="col">Cliente</th>
                <th scope="col">Fecha</th>
                <th scope="col">Total impuesto (Lps.)</th>
                <th scope="col">Total compra (Lps.)</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total = 0;
                $impuesto = 0;
            @endphp
            @forelse ($ventas as $compra)
                <tr class='active'>
                    <td scope="col">{{ $compra->NumFactura }}</td>
                    <td scope="col">{{ $compra->personals->NombresDelEmpleado }} {{ $compra->personals->ApellidosDelEmpleado }}</td>
                    @if ($compra->cliente_id == null)
                        <td scope="col">Consumidor final</td>
                    @else
                        <td scope="col">{{ $compra->clientes->NombresDelCliente }} {{ $compra->clientes->ApellidosDelCliente }}</td>
                    @endif
                    <td scope="col">{{ $compra->FechaVenta }}</td>
                    <td scope="col">{{ $compra->TotalImpuesto }}</td>
                    <td scope="col">{{ $compra->TotalVenta }}</td>

                    @php
                        $total = $total + $compra->TotalVenta;
                        $impuesto = $impuesto + $compra->TotalImpuesto;
                    @endphp
                </tr>
            @empty
                <tr>
                    <td colspan='4'> No hay ventas </td>
                </tr>
            @endforelse

        </tbody>
        <tfoot>
            <th scope='col' colspan='4'>Total reporte</th>
            <th scope='col'>Lps. {{ $impuesto }}</th>
            <th scope='col'>Lps. {{ $total }}</th>
        </tfoot>
    </table>
</body>

</html>
