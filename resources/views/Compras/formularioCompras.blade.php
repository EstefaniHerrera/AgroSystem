@extends('Plantillas.plantilla')
@section('titulo', 'Formulario De Compras')
@section('contenido')

    <h1> Registro de compra </h1>
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


    <form id="form_guardar" name="form_guardar" method="POST" action="{{ route('compras.guardar') }}" onsubmit="confirmar()">
        @csrf
        <div class="row" style="width: 87%">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="NumFactura"> Número de factura </label>
                    <input type="text" style="width: 100%" class="form-control" name="NumFactura" id="NumFactura"
                        placeholder="Número de factura sin guiones" pattern="[0-9]{16}" required maxlength="16"
                        {{-- #40. Corrección de la factura de compras --}}
                        value="{{ $numerCompra }}" title="Ingrese 16 caracteres sin guiones">
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label for="">Seleccione de que forma realizará la compra </label><br>
                    {{-- #40. Corrección de la factura de compras --}}
                    <input required type="radio" id="Contado" name="PagoCompra" value="0" @if ($tipoPago == 0) @checked(true) @endif> Al contado <br>
                    <input required type="radio" id="Crédito" name="PagoCompra" value="1" @if ($tipoPago == 1) @checked(true) @endif onchange="fp()" > A
                    crédito
                </div>
            </div>
        </div>
        <script>
            function fp() {
                document.getElementById("FechaPago").required = true;
            }

            function maxlengthNumber(obj){
                if(obj.value.length > obj.maxLength){
                    obj.value = obj.value.slice(0, obj.maxLength);
                }
            }
        </script>

        <div class="row" style="width: 87%">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="Proveedor"> Proveedor </label>
                    <select name="Proveedor" id="Proveedor" class="select222" required style="width: 100%">
                        <option style="display: none;" value="">Seleccione un proveedor</option>
                        @foreach ($proveedor as $p)
                        {{-- #40. Corrección de la factura de compras --}}
                            <option value="{{ $p->id }}" @if($proveedorId == $p->id) @selected(true) @endif>{{ $p->EmpresaProveedora }}</option>
                        @endforeach
                    </select>

                </div>
            </div>
            <?php
            $fecha_actual = date('d-m-Y');
            ?>
            <div class="col-sm-4">
                <div class="form-group">
                    <label style="width: 100%" for="FechaCompra"> Fecha de la compra </label>
                    {{-- #40. Corrección de la factura de compras --}}
                    <input style="width: 100%" value="{{ $fechaCompra }}" type="date" class="form-control" name="FechaCompra" id="FechaCompra"
                        required maxlength="40" min="<?php echo date('Y-m-d', strtotime($fecha_actual . '- 1 month')); ?>" max="<?php echo date('Y-m-d', strtotime($fecha_actual )); ?>">
                </div>

            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <!--Correccion del error N34 se establecio limite en el año -->
                    {{-- #40. Corrección de la factura de compras --}}
                    <label style="width: 100%" for=""> Fecha del pago </label>
                    <input style="width: 100%" type="date" name="FechaPago"
                        class="form-control {{ $errors->has('FechaPago') ? 'is-invalid' : '' }}"
                        value="{{ $fechaPago }}" id="FechaPago" title="Ingrese la fecha en la que hara el pago"
                        min="<?php echo date('Y-m-d', strtotime($fecha_actual . '+ 1 day')); ?>" max="
                         <?php echo date('Y-m-d', strtotime($fecha_actual . '+ 28 day')); ?>">
                </div>
            </div>

        </div>

        <div class="row" style="width: 100%">
            <div class="col-sm-6">
                {{-- #40. Corrección de la factura de compras --}}
                <button data-toggle="modal" data-target="#agreagar_detalle" onclick="agregar_cliente()" type="button" class="btn"
                    style="background-color:rgb(65, 145, 126); border-color:black; color:white">
                    <span class="glyphicon glyphicon-plus-sign"></span>
                    Agregar detalles</button>
                <a class="btn" style="background-color:rgb(65, 145, 126); border-color:black; color:white"
                    href="{{ route('proveedor.crear2') }}">
                    <span class="glyphicon glyphicon-share"></span>
                    Ir a proveedores
                </a>
            </div>
            <div class="col-sm-4">
            </div>
            <div class="col-sm-4">
            </div>
        </div>
        <br>


            <div class="row" style="width: 100%">
                <div class="col-sm-16">
                    <div class="table-responsive">
                    <table class="table table-bordered border-dark mt-3">
                        <thead class="table table-striped table-hover">
                            <tr class="success">
                                <th scope="col">N°</th>
                                <th scope="col">Producto</th>
                                <th scope="col">Presentación</th>
                                <th scope="col">Precio de compra</th>
                                <th scope="col">Precio de venta</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Total producto</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($detalles as $i => $de)
                                <tr class="active">
                                    <th scope="row">{{ $i + 1 }}</th>
                                    <td scope="col">
                                        {{ $de->producto->NombreDelProducto . ', ' . $de->producto->DescripciónDelProducto }}
                                    </td>
                                    <td scope="col">{{ $de->presentacion->informacion }}</td>
                                    <td scope="col">{{ $de->Precio_compra }}</td>
                                    <td scope="col">{{ $de->Precio_venta }}</td>
                                    <td scope="col">{{ $de->Cantidad }}</td>
                                    <td scope="col">{{ $de->Cantidad * $de->Precio_compra }}</td>
                                    <td>
                                        <a href={{ '/detalle_compra/eliminar/' . $de->id }} class="btn btn-danger"
                                            style="border-color:black; color:white;">
                                            <span class="glyphicon glyphicon-trash"></span>
                                            Eliminar
                                        </a>
                                    </td>
                                    <td>
                                        <button
                                            onclick="editar_detalle(  {{ $de->producto->id }},
                                                                                {{ $de->producto->categoria_id }},
                                                                                {{ $de->IdPresentacion }},
                                                                                '{{ $de->fecha_vencimiento }}',
                                                                               '{{ $de->fecha_elaboración }}',
                                                                               '{{ $de->Cantidad }}',
                                                                               '{{ $de->Precio_venta }}',
                                                                               '{{ $de->Precio_compra }}',
                                                                               {{ $de->id }})"
                                            data-toggle="modal" data-target="#editar_detalle" type="button"
                                            class="btn btn-success" style="border-color:black; color:white;">
                                            <span class="glyphicon glyphicon-edit"></span>
                                            Editar
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4"> No hay detalles agregados </td>
                                </tr>
                            @endforelse

                        </tbody>
                        <tfoot>
                            <tr class="active">
                                <td colspan="6">
                                    <div class="form-group">
                                        <label style="width: 100%" for="">Subtotal</label>
                                    </div>
                                </td>
                                <td colspan="3"><input style="width: 100%" readonly type="email" name="TotalCompra"
                                        class="form-control {{ $errors->has('TotalCompra') ? 'is-invalid' : '' }}"
                                        value="{{ $total_precio }}" id="TotalCompra" required title="Subtotal">
                                </td>
                            </tr>
                            <tr class="active">
                                <td colspan="6"><label style="width: 100%" for="">Impuesto</label></td>
                                <td colspan="3"><input style="width: 100%" readonly type="email"
                                        name="TotalImpuesto"
                                        class="form-control {{ $errors->has('TotalImpuesto') ? 'is-invalid' : '' }}"
                                        value="{{ round($total_impuesto, 2) }}" id="TotalImpuesto" required
                                        title="Total del impuesto"></td>
                            </tr>
                            <tr class="active">
                                <td colspan="6"><label style="width: 100%" for="">Total compra</label></td>
                                <td colspan="3"><input style="width: 100%" readonly type="email"
                                        name="TotalCompraT"
                                        class="form-control {{ $errors->has('TotalCompraT') ? 'is-invalid' : '' }}"
                                        value="{{ round($total_precio + $total_impuesto, 2) }}" id="TotalCompraT"
                                        required title="Total de la Compra">
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
        </div>


        <br>
        <input type="submit" class="btn btn-primary" value="Guardar">
        <a class="btn btn-danger" href="#" onclick="limpiarCompra()">Limpiar</a>
        <a class="btn btn-info" href="{{ route('compras.index') }}">Cerrar</a>

        {{--  --}}

    </form>

    {{-- Modal de agregar detalle --}}
    <div class="modal fade" id="agreagar_detalle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('detalle_compra.crear') }}" method="POST">
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
                                    <select name="IdCategoria" id="IdCategoria" style="width: 95%" class="form-control"
                                        onchange="cambio()" required>
                                        <option style="display: none" value="">Seleccione una categoría</option>
                                        @foreach ($categoria as $cat)
                                            <option value="{{ $cat->id }}"
                                                @if (old('IdCategoria') == $cat->id) @selected(true) @endif>
                                                {{ $cat->NombreDeLaCategoría }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- #40. Corrección de la factura de compras --}}
                                <input type="text" name="n_NumFactura" id="n_NumFactura" hidden>
                                <input type="text" name="n_Proveedor" id="n_Proveedor" hidden>
                                <input type="text" name="n_FechaCompra" id="n_FechaCompra" hidden>
                                <input type="text" name="n_FechaPago" id="n_FechaPago" hidden>
                                <input type="text" name="n_TipoPago" id="n_TipoPago" hidden>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Producto</label>
                                    <select name="IdProducto" id="IdProducto" style="width: 100%" class="form-control"
                                        onchange="impuesto()" required>
                                        @if (old('IdProducto'))
                                            @foreach ($productos as $prod)
                                                @if (old('IdProducto') == $prod->id)
                                                    <option style="display: none" value="{{ old('IdProducto') }}">
                                                        {{ $prod->NombreDelProducto }}</option>
                                                @endif
                                            @endforeach
                                        @else
                                            <option style="display: none" value="">Seleccione un producto</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <script>
                            function cambio() {
                                $("#IdProducto").find('option').not(':first').remove();
                                $("#IdPresentacion").find('option').not(':first').remove();
                                var select = document.getElementById("IdCategoria");
                                var valor = select.value;
                                var selectnw = document.getElementById("IdProducto");
                                var selectpw = document.getElementById("IdPresentacion");

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

                                if (valor != 3 && valor != 4 && valor != 6) {
                                    document.getElementById("fecha_elaboración").required = true;
                                    document.getElementById("fecha").required = true;
                                }

                            }

                            function impuesto() {
                                var select = document.getElementById("IdProducto");
                                var valor = select.value;

                                @foreach ($productos as $p)
                                    if ({{ $p->id }} == valor) {
                                        document.getElementById("calimp").value = 'El producto tiene ' + {{ $p->Impuesto * 100 }} +
                                            '% de impuestos.';
                                    }
                                @endforeach

                            }
                        </script>

                        <div class="row" style="width: 100%">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Presentación</label>
                                    <select name="IdPresentacion" id="IdPresentacion" style="width: 100%"
                                        class="form-control" required>
                                        @if (old('IdPresentacion'))
                                            @foreach ($presentacion as $pre)
                                                @if (old('IdPresentacion') == $pre->id)
                                                    <option style="display: none" value="{{ old('IdPresentacion') }}">
                                                        {{ $pre->informacion }}</option>
                                                @endif
                                            @endforeach
                                        @else
                                            <option style="display: none" value="">Seleccione una presentación
                                            </option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <!--Correccion del error N35 se establecio limite en el campo -->
                                    <label style="width: 100%" for="">Precio de compra</label>
                                    <input style="width: 100%" type="number" name="Precio_compra"
                                        class="form-control {{ $errors->has('Precio_compra') ? 'is-invalid' : '' }}"
                                        value="{{ old('Precio_compra') }}" id="Precio_compra" required
                                        title="Ingrese el precio de compra en números sin decimales." pattern="[0-9]+"
                                        maxlength="4" placeholder="0.00" min="1" max="9998"
                                        onchange="pv()" oninput="maxlengthNumber(this);">
                                </div>
                            </div>
                        </div>
                        <script>
                            function pv() {
                                var select = document.getElementById("Precio_compra");
                                var valor = Number(select.value);
                                document.getElementById("Precio_venta").min = 1 + valor;

                            }
                        </script>

                        <div class="row" style="width: 100%">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <!--Correccion del error N36 se establecio limite en el campo -->
                                    <label style="width: 100%" for="">Precio de venta</label>
                                    <input style="width: 100%" type="number" name="Precio_venta"
                                        class="form-control {{ $errors->has('Precio_venta') ? 'is-invalid' : '' }}"
                                        value="{{ old('Precio_venta') }}" id="Precio_venta" required
                                        title="Ingrese el precio de venta en números sin decimales." pattern="[0-9]+"
                                        maxlength="4" placeholder="0.00" min="" max="9999"
                                           oninput="maxlengthNumber(this);">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <!--Correccion del error N37 se establecio limite en el campo -->
                                    <label style="width: 100%" for="">Cantidad</label>
                                    <input style="width: 100%" type="number" name="Cantidad"
                                        class="form-control {{ $errors->has('Cantidad') ? 'is-invalid' : '' }}"
                                        value="{{ old('Cantidad') }}" id="Cantidad" required
                                        title="Ingrese cantidad de la compra en números." maxlength="4" pattern="[0-9]+"
                                        placeholder="0" min="1" max="9999"
                                           oninput="maxlengthNumber(this);">
                                </div>
                            </div>
                        </div>
                        <div class="row" style="width: 100%">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label style="width: 100%" for="">Fecha de elaboración</label>
                                    <input style="width: 100%" type="date" name="fecha_elaboración"
                                        class="form-control {{ $errors->has('fecha') ? 'is-invalid' : '' }}"
                                        id="fecha_elaboración" title="Ingrese la fecha de elaboración"
                                        value="{{ old('fecha_elaboración') }}" min="<?php echo date('Y-m-d', strtotime($fecha_actual . '- 2 year')); ?>"
                                        max="<?php echo date('Y-m-d', strtotime($fecha_actual . '- 1 day')); ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <!--Correccion del error N38 se establecio limite en el año -->
                                    <label style="width: 100%" for="">Fecha de vencimiento</label>
                                    <input style="width: 100%" type="date" name="fecha"
                                        class="form-control {{ $errors->has('fecha') ? 'is-invalid' : '' }}"
                                        value="{{ old('fecha', 0) }}" id="fecha"
                                        title="Ingrese la fecha de vencimiento" min="<?php echo date('Y-m-d', strtotime($fecha_actual . '+ 1 day')); ?>"
                                           max="<?php echo date('Y-m-d', strtotime($fecha_actual . '+ 3 years')); ?>">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <input class="form-control" id="calimp" name="calimp"
                                style="width: 95%;text-align: center;color: black" type="text"
                                value="{{ old('calimp', ' ') }}" readonly>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <a class="btn btn-info" href="{{ route('categoria.crear2') }}">Ir a categorías</a>
                        <a class="btn btn-info" href="{{ route('producto.crear2') }}">Ir a productos </a>
                        <button type="submit" class="btn btn-primary">Agregar a la compra</button>
                    </div>

                </form>
            </div>
        </div>
    </div>




    {{-- Modal de editar los detalles --}}
    <div class="modal fade" id="editar_detalle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('detalle_compra.editar') }}" method="POST">
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
                                        class="form-control" onchange="e_cambio()" required>
                                        <option style="display: none" value="">Seleccione una categoría</option>
                                        @foreach ($categoria as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->NombreDeLaCategoría }}</option>
                                        @endforeach
                                    </select>

                                    <input type="text" name="IdDetalle" id="e_IdDetalle" hidden>
                                    {{-- #40. Corrección de la factura de compras --}}
                                    <input type="text" name="e_NumFactura" id="e_NumFactura" hidden>
                                    <input type="text" name="e_Proveedor" id="e_Proveedor" hidden>
                                    <input type="text" name="e_FechaCompra" id="e_FechaCompra" hidden>
                                    <input type="text" name="e_FechaPago" id="e_FechaPago" hidden>
                                    <input type="text" name="e_TipoPago" id="e_TipoPago" hidden>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Producto</label>
                                    <select name="IdProducto" id="e_IdProducto" style="width: 100%" class="form-control"
                                        onchange="e_impuesto()" required>
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

                                if (valor != 3 && valor != 4 && valor != 6) {
                                    document.getElementById("e_fecha_elaboración").required = true;
                                    document.getElementById("e_fecha").required = true;
                                }

                            }

                            function e_impuesto() {
                                var select = document.getElementById("e_IdProducto");
                                var valor = select.value;

                                @foreach ($productos as $p)
                                    if ({{ $p->id }} == valor) {
                                        document.getElementById("e_calimp").value = 'El producto tiene ' + {{ $p->Impuesto * 100 }} +
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
                                        class="form-control" required>
                                        <option style="display: none" value="">Seleccione una presentación</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <!--Correccion del error N42 se establecio limite en el campo -->
                                    <label style="width: 100%" for="">Precio de compra</label>
                                    <input style="width: 100%" type="number" name="Precio_compra"
                                        class="form-control {{ $errors->has('Precio_compra') ? 'is-invalid' : '' }}"
                                        value="{{ old('Precio_compra') }}" id="e_Precio_compra" required
                                        onchange="e_pv()" title="Ingrese el precio de compra en números sin decimales."
                                        maxlength="4" pattern="[0-9]+" placeholder="0.00" min="1"
                                        max="9999" oninput="maxlengthNumber(this);" >
                                </div>
                            </div>
                        </div>

                        <script>
                            function e_pv() {
                                var select = document.getElementById("e_Precio_compra");
                                var valor = Number(select.value);
                                document.getElementById("e_Precio_venta").min = 1 + valor;

                            }
                        </script>

                        <div class="row" style="width: 100%">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <!--Correccion del error N43 se establecio limite en el campo -->
                                    <label style="width: 100%" for="">Precio de venta</label>
                                    <input style="width: 100%" type="number" name="Precio_venta"
                                        class="form-control {{ $errors->has('Precio_venta') ? 'is-invalid' : '' }}"
                                        value="{{ old('Precio_venta') }}" id="e_Precio_venta" required
                                        title="Ingrese el Precio de venta en números." maxlength="4" pattern="[0-9]+"
                                        placeholder="0.00" max="9999" oninput="maxlengthNumber(this);">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <!--Correccion del error N44 se establecio limite en el campo -->
                                    <label style="width: 100%" for="">Cantidad</label>
                                    <input style="width: 100%" type="number" name="Cantidad"
                                        class="form-control {{ $errors->has('Cantidad') ? 'is-invalid' : '' }}"
                                        value="{{ old('Cantidad') }}" id="e_Cantidad" required
                                        title="Ingrese cantidad de la compra en números." maxlength="4" pattern="[0-9]+"
                                        placeholder="0" min="1"
                                           oninput="maxlengthNumber(this);"
                                    >
                                </div>
                            </div>
                        </div>

                        <div class="row" style="width: 100%">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label style="width: 100%" for="">Fecha de elaboración</label>
                                    <input style="width: 100%" type="date" name="fecha_elaboración"
                                        class="form-control {{ $errors->has('fecha') ? 'is-invalid' : '' }}"
                                        id="e_fecha_elaboración" title="Ingrese la fecha de elaboración"
                                        min="<?php echo date('Y-m-d', strtotime($fecha_actual . '- 2 years')); ?>" max="<?php echo date('Y-m-d', strtotime($fecha_actual . '- 1 day')); ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <!--Correccion del error N45 se establecio limite en el año -->
                                    <label style="width: 100%" for="">Fecha de vencimiento</label>
                                    <input style="width: 100%" type="date" name="fecha"
                                        class="form-control {{ $errors->has('fecha') ? 'is-invalid' : '' }}"
                                        value="{{ old('fecha', 0) }}" id="e_fecha"
                                        title="Ingrese la fecha de vencimiento"
                                           min="<?php echo date('Y-m-d', strtotime($fecha_actual . '+ 1 day')); ?>"
                                           max="<?php echo date('Y-m-d', strtotime($fecha_actual . '+ 3 years')); ?>"

                                    >
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <input class="form-control" id="e_calimp" style="width: 95%;text-align: center;color: black"
                                type="text" value="" disabled>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <a class="btn btn-info" href="{{ route('categoria.crear2') }}">Ir a categorías</a>
                        <a class="btn btn-info" href="{{ route('producto.crear2') }}">Ir a productos </a>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>


@endsection

@section('js')
    @push('alertas')
        <script>
            $(document).ready(function() {
                // $(".select222").select2({
                //     width: 'resolve' // need to override the changed default
                // });

                new TomSelect(".select222", {
                    create: false,
                    sortField: {
                        field: "text",
                        direction: "asc"
                    }
                });

            });

            /* #40. Corrección de la factura de compras */
            function agregar_cliente() {
                let Contado = document.getElementById("Contado").checked;
                let Credito = document.getElementById("Crédito").checked;
                var valor = 0;
                if (Contado) {
                    valor = 0;
                } else{
                    if(Credito) {
                        valor = 1;
                    }
                }
                    $('#e_NumFactura').val($('#NumFactura').val());
                    $('#e_Proveedor').val($('#Proveedor').val());
                    $('#e_FechaCompra').val($('#FechaCompra').val());
                    $('#e_FechaPago').val($('#FechaPago').val());
                    $('#e_TipoPago').val(valor);
                    $('#n_NumFactura').val($('#NumFactura').val());
                    $('#n_Proveedor').val($('#Proveedor').val());
                    $('#n_FechaCompra').val($('#FechaCompra').val());
                    $('#n_FechaPago').val($('#FechaPago').val());
                    $('#n_TipoPago').val(valor);

            }

            function editar_detalle(IdProducto, categoria_id, IdPresentacion, fecha, fecha_elaboración, Cantidad, Precio_venta,
                Precio_compra, id) {
                $('#e_IdCategoria').val(categoria_id);
                e_cambio();
                $('#e_IdProducto').val(IdProducto);
                $('#e_IdPresentacion').val(IdPresentacion);
                e_impuesto();
                $('#e_fecha').val(fecha);
                $('#e_fecha_elaboración').val(fecha_elaboración);
                $('#e_Cantidad').val(Cantidad);
                $('#e_Precio_venta').val(Precio_venta);
                $('#e_Precio_compra').val(Precio_compra);
                $('#e_IdDetalle').val(id);

                /* #40. Corrección de la factura de compras */
                agregar_cliente();
                

            }

            function confirmar() {
                var formul = document.getElementById("form_guardar");


                Swal.fire({
                    title: '¿Está seguro que desea guardar los datos de esta nueva compra?',
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

            function limpiarCompra() {
                Swal.fire({
                    title: '¿Está seguro que desea limpiar los datos de la compra?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '/compras/limpiar';
                    }

                })

            }
        </script>
    @endpush
@endsection
