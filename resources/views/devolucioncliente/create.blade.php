@extends('Plantillas.plantilla')
@section('titulo', 'Formulario De Devolucion de cliente')
@section('contenido')
    <div class="container-fluid">
        <h1> Registro de devolución del cliente </h1>
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

        {{-- /////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}

        <form id="form_guardar" name="form_guardar" method="POST" action="{{ route('devolucioncliente.guardar') }}"
            onsubmit="confirmar()">
            @csrf
            <div class="row" style="width: 100%">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="NumFactura"> Número de factura </label>
                        <input type="text" readonly style="width: 100%" name="NumFactura"
                            class="form-control {{ $errors->has('NumFactura') ? 'is-invalid' : '' }}" id="NumFactura"
                            placeholder="Número de factura sin guiones" required value="{{ $venta->NumFactura }}">
                        <input type="text" name="IdVenta" id="IdVenta" hidden value="{{ $clientepedido }}">
                    </div>

                </div>

                <div class="col-sm-6">
                    <div class="row" style="width: 100%">
                        <div class="form-group">
                            <label for="Empleado"> Empleado que realizó la venta</label>
                            <input type="text" readonly style="width: 100%" name="Per"
                                class="form-control {{ $errors->has('Per') ? 'is-invalid' : '' }}" id="Per" required
                                value="{{ $per->NombresDelEmpleado }} {{ $per->ApellidosDelEmpleado }}">
                        </div>
                    </div>
                </div>

            </div>

            <div class="row" style="width: 100%">
                <div class="col-sm-6">
                    <label for="Cliente"> Cliente </label>
                    <input type="text" readonly style="width: 100%" name="Cliente"
                        class="form-control {{ $errors->has('Cliente') ? 'is-invalid' : '' }}" id="Cliente" required
                        value="{{ $clien }}">

                </div>

                <div class="col-sm-6">
                    <div class="row" style="width: 100%">
                        <div class="form-group">
                            <label for="Empleado"> Empleado que realiza la devolución</label>
                            <select name="Empleado" id="Empleado" class="form-control" required style="width: 100%">
                                <option style="display: none;" value="">Seleccione un empleado</option>
                                @foreach ($empleado as $e)
                                    @if ($e->EmpleadoActivo == 'Activo')
                                        <option value="{{ $e->id }}"
                                            @if (old('Empleado') == $e->id) @selected(true) @endif>
                                            {{ $e->NombresDelEmpleado }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row" style="width: 100%">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label style="width: 100%" for="FechaVenta"> Descripción </label>
                        <textarea style="width: 100%" type="text" class="form-control" name="descripcion" id="descripcion" required
                            maxlength="200" placeholder="Breve descripción del motivo por el cual se devuelven los productos">{{ old('descripcion') }}</textarea>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="row" style="width: 100%">
                        <div class="form-group">
                            <label style="width: 100%" for="FechaVenta"> Fecha de la devolución </label>
                            <input style="width: 100%" readonly type="date" class="form-control" name="FechaVenta"
                                id="FechaVenta" required maxlength="40" value="{{ now()->format('Y-m-d') }}">
                        </div>
                    </div>
                </div>
            </div>

            <br>
            <br>

            <div class="table-responsive">
                <table class="table table-bordered border-dark mt-3">
                    <thead class="table table-striped table-hover">
                        <tr class="success">
                            <th scope="col">N°</th>
                            <th scope="col">Producto</th>
                            <th scope="col">Presentación</th>
                            <th scope="col">Precio de venta</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Total producto</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($detalleventa as $i => $de)
                            <tr class="active">
                                <th scope="row">{{ $i + 1 }}</th>
                                <td scope="col">
                                    {{ $de->producto->NombreDelProducto }}
                                </td>
                                <td scope="col">{{ $de->presentacion->informacion }}</td>
                                <td scope="col">{{ $de->Precio_venta }}</td>
                                <td scope="col">{{ $de->Cantidad }}</td>
                                <td scope="col">{{ $de->Cantidad * $de->Precio_venta }}</td>
                                <td>
                                    <button
                                        onclick="editar_detalle(  {{ $de->producto->id }},
                                    {{ $de->producto->categoria_id }},
                                    {{ $de->IdPresentacion }},
                                   '{{ $de->Cantidad }}',
                                   '{{ $de->Precio_venta }}',
                                   {{ $de->id }})"
                                        data-toggle="modal" data-target="#editar_detalle" type="button"
                                        class="btn btn-info" style="border-color:black; color:white;">
                                        <span class="glyphicon glyphicon-retweet"></span>
                                        Devolver producto
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4"> Se han devuelto todos los productos </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
            <br>
            <h3>Productos devueltos</h3><br>
            <div class="table-responsive">
                <table class="table table-bordered border-dark mt-3">
                    <thead class="table table-striped table-hover">
                        <tr class="success">
                            <th scope="col">N°</th>
                            <th scope="col">Producto</th>
                            <th scope="col">Presentación</th>
                            <th scope="col">Precio de venta</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Total producto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($detalledevolucion as $i => $de)
                            <tr class="active">
                                <th scope="row">{{ $i + 1 }}</th>
                                <td scope="col">
                                    {{ $de->producto->NombreDelProducto }}
                                </td>
                                <td scope="col">{{ $de->presentacion->informacion }}</td>
                                <td scope="col">{{ $de->Precio_venta }}</td>
                                <td scope="col">{{ $de->Cantidad }}</td>
                                <td scope="col">{{ $de->Cantidad * $de->Precio_venta }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4"> No hay detalles agregados </td>
                            </tr>
                        @endforelse

                    </tbody>
                    <tfoot>
                        <tr class="active">
                            <td colspan="5">
                                <div class="form-group">
                                    <label style="width: 100%" for="">Subtotal</label>
                                </div>
                            </td>
                            <td colspan="3"><input style="width: 100%" readonly type="email" name="TotalVenta"
                                    class="form-control {{ $errors->has('TotalVenta') ? 'is-invalid' : '' }}"
                                    value="{{ $total_precio }}" id="TotalVenta" required title="Subtotal de la Venta">
                            </td>
                        </tr>
                        <tr class="active">
                            <td colspan="5"><label style="width: 100%" for="">Impuesto</label></td>
                            <td colspan="3"><input style="width: 100%" readonly type="email" name="TotalImpuesto"
                                    class="form-control {{ $errors->has('TotalImpuesto') ? 'is-invalid' : '' }}"
                                    value="{{ round($total_impuesto, 2) }}" id="TotalImpuesto" required
                                    title="Total del impuesto"></td>
                        </tr>
                        <tr class="active">
                            <td colspan="5"><label style="width: 100%" for="">Total devolución
                                </label></td>
                            <td colspan="3"><input style="width: 100%" readonly type="email" name="TotalVentaT"
                                    class="form-control {{ $errors->has('TotalVentaT') ? 'is-invalid' : '' }}"
                                    value="{{ round($total_precio + $total_impuesto, 2) }}" id="TotalVentaT" required
                                    title="Total de la Venta">
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <br>
            <input type="submit" class="btn btn-primary" value="Guardar">
            <a class="btn btn-danger" href="#" onclick="limpiarVenta({{ $clientepedido }})">Limpiar</a>
            <a class="btn btn-info" href="{{ route('devolucioncliente.cerrar') }}">Cerrar</a>

            {{--  --}}

        </form>

        {{-- Modal de editar los detalles --}}
        <div class="modal fade" id="editar_detalle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ route('detalle_devolucioncliente.crear', ['IdDevolucion' => $clientepedido]) }}"
                        method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Agregar detalles</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">

                            <div class="row" style="width: 100%">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Categoría</label>
                                        <select name="IdCategoria" id="e_IdCategoria" style="width: 95%"
                                            class="form-control" onchange="e_cambio()" required disabled>
                                            <option style="display: none" value="">Seleccione una categoría</option>
                                            @foreach ($categoria as $cat)
                                                <option value="{{ $cat->id }}">{{ $cat->NombreDeLaCategoría }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <input type="text" name="IdDetalle" id="e_IdDetalle" hidden>
                                        <input type="text" name="e_Idcliente" id="e_Idcliente" hidden>

                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Producto</label>
                                        <select name="IdProducto" id="e_IdProducto" style="width: 100%"
                                            class="form-control" onchange="e_impuesto()" required disabled>
                                            <option style="display: none" value="">Seleccione un producto</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <script>
                                function e_cambio() {
                                    $("#e_IdProducto").find('option').not(':first').remove();
                                    $("#e_IdPresentacion").find('option').not(':first').remove();
                                    var select = document.getElementById("e_IdCategoria");
                                    var valor = select.value;
                                    var selectnw = document.getElementById("e_IdProducto");
                                    var selectpw = document.getElementById("e_IdPresentacion");

                                    @foreach ($productos as $p)
                                        if ({{ $p->categoria_id }} == valor) {

                                            // creando la nueva option
                                            var opt = document.createElement('option');

                                            // Añadiendo texto al elemento (opt)
                                            opt.innerHTML = "{{ $p->NombreDelProducto }}";

                                            //Añadiendo un valor al elemento (opt)
                                            opt.value = "{{ $p->id }}";

                                            // Añadiendo opt al final del selector (sel)
                                            selectnw.appendChild(opt);

                                        }
                                    @endforeach

                                    @foreach ($presentacion as $p)
                                        if ({{ $p->categoria_id }} == valor) {

                                            // creando la nueva option
                                            var opt = document.createElement('option');

                                            // Añadiendo texto al elemento (opt)
                                            opt.innerHTML = "{{ $p->informacion }}";

                                            //Añadiendo un valor al elemento (opt)
                                            opt.value = "{{ $p->id }}";

                                            // Añadiendo opt al final del selector (sel)
                                            selectpw.appendChild(opt);

                                        }
                                    @endforeach

                                }

                                function e_impuesto() {
                                    var select = document.getElementById("e_IdProducto");
                                    var valor = select.value;

                                    @foreach ($productos as $p)
                                        if ({{ $p->id }} == valor) {
                                            document.getElementById("e_calimp").value = '' + {{ $p->Impuesto * 100 }} +
                                                '% de impuestos.';
                                        }
                                    @endforeach

                                }
                            </script>

                            <div class="row" style="width: 100%">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Presentación</label>
                                        <select name="IdPresentacion" id="e_IdPresentacion" style="width: 100%"
                                            class="form-control" onchange="e_precio()" required disabled>
                                            <option style="display: none" value="">Seleccione una presentación
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label style="width: 100%" for="">Precio de venta</label>
                                        <input style="width: 100%" type="number" readonly name="Precio_venta"
                                            class="form-control" value="" id="e_Precio_venta"
                                            title="Ingrese el Precio de venta">
                                    </div>
                                </div>
                            </div>

                            <script>
                                function e_precio() {
                                    var select = document.getElementById("e_IdPresentacion");
                                    var valor = select.value;
                                    var select1 = document.getElementById("e_IdProducto");
                                    var valor1 = select1.value;
                                    var select2 = document.getElementById("e_Idcliente");
                                    var valor2 = select2.value;

                                    document.getElementById("e_Precio_venta").value = 0;

                                    @foreach ($precios as $p)
                                        if ({{ $p->IdProducto }} == valor1 && {{ $p->IdPresentación }} == valor) {
                                            document.getElementById("e_Precio_venta").value = '{{ $p->Precio }}';
                                        }
                                    @endforeach

                                    document.getElementById("e_Cantidad").max = valor2;

                                }
                            </script>

                            <div class="row" style="width: 100%">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label style="width: 100%" for=""> Impuesto </label>
                                        <input class="form-control" id="e_calimp"
                                            style="width: 100%; text-align: center;color: black" type="text"
                                            value="" disabled>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label style="width: 100%" for="">Cantidad</label>
                                        <input style="width: 100%" type="number" name="Cantidad"
                                            class="form-control {{ $errors->has('Cantidad') ? 'is-invalid' : '' }}"
                                            value="{{ old('Cantidad') }}" id="e_Cantidad" required placeholder="0"
                                            title="Ingrese cantidad de la compra en números." maxlength="4"
                                            pattern="[0-9]+" min="1">
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Devolver</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- /////////////////////////////////////////////// --}}

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

                function editar_detalle(IdProducto, categoria_id, IdPresentacion, Cantidad, Precio_venta, id) {
                    $('#e_IdCategoria').val(categoria_id);
                    e_cambio();
                    $('#e_IdProducto').val(IdProducto);
                    $('#e_IdPresentacion').val(IdPresentacion);
                    e_impuesto();
                    e_precio();
                    $('#e_Precio_venta').val(Precio_venta);
                    $('#e_Cantidad').val(Cantidad);
                    $('#e_IdDetalle').val(id);
                    $('#e_Idcliente').val(Cantidad);

                }

                function confirmar() {
                    var formul = document.getElementById("form_guardar");


                    Swal.fire({
                        title: '¿Está seguro que desea guardar los datos de esta devolución?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        cancelButtonText: 'Cancelar',
                        confirmButtonText: 'Aceptar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            formul.submit();
                        }

                    })

                    event.preventDefault()


                }

                function limpiarVenta(cliente) {
                    var n = "/devolucioncliente/limpiar/" + cliente;
                    Swal.fire({
                        title: '¿Está seguro que desea limpiar los datos de la devolución?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        cancelButtonText: 'Cancelar',
                        confirmButtonText: 'Aceptar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location = n;
                        }

                    })

                }
            </script>
        @endpush
    </div>

@endsection
