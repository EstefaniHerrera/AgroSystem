@extends('Plantillas.plantilla')
@section('titulo', 'Formulario De Cotizaciones')
@section('contenido')

    <h1> Cotizaciones de productos </h1>
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

    <form id="form_guardar" name="form_guardar" method="POST" action="{{ route('cotizaciones.guardar') }}"
        onsubmit="confirmar()">
        @csrf
        <div class="row" style="width: 100%">
            <div class="col-sm-12">            
            
                <button data-toggle="modal" data-target="#agreagar_detalle" type="button" class="btn"
                    style="background-color:rgb(65, 145, 126); border-color:black; color:white">
                    <span class="glyphicon glyphicon-plus-sign"></span>
                    Agregar detalles
                </button>
                <input type="submit" class="btn btn-primary" value="Guardar">
                <a class="btn btn-danger" href="#" onclick="limpiarVenta()">Limpiar</a>
                <a class="btn btn-info" href="{{ route('ventas.index') }}">Cerrar</a>
            </div>
            <div class="col-sm-4">
            </div>
            <div class="col-sm-4">
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
                                <th scope="col">N??</th>
                                <th scope="col">Producto</th>
                                <th scope="col">Presentaci??n</th>
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
                                        {{ $de->producto->NombreDelProducto }}
                                    </td>
                                    <td scope="col">{{ $de->presentacion->informacion }}</td>
                                    <td scope="col">{{ $de->Precio_venta }}</td>
                                    <td scope="col">{{ $de->Cantidad }}</td>
                                    <td scope="col">{{ $de->Cantidad * $de->Precio_venta }}</td>
                                    <td>
                                        <a href={{ ' /detalle_cotizacion/eliminar/' . $de->id }} class="btn btn-danger"
                                            class="btn btn-danger" style="border-color:black; color:white;">
                                            <span class="glyphicon glyphicon-trash"></span>
                                            Eliminar
                                        </a>
                                    </td>
                                    <td>
                                        <button
                                            onclick="editar_detalle(  {{ $de->producto->id }},
                                                                                                    {{ $de->producto->categoria_id }},
                                                                                                    {{ $de->IdPresentacion }},
                                                                                                   '{{ $de->Cantidad }}',
                                                                                                   '{{ $de->Precio_venta }}',
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
                                <td colspan="5"><label style="width: 100%" for="">Total compra</label></td>
                                <td colspan="3"><input style="width: 100%" readonly type="email" name="TotalVentaT"
                                        class="form-control {{ $errors->has('TotalVentaT') ? 'is-invalid' : '' }}"
                                        value="{{ round($total_precio + $total_impuesto, 2) }}" id="TotalVentaT" required
                                        title="Total de la Venta">
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

            </div>


        </div>
    </form>

    {{-- Modal de agregar detalle --}}
    <div class="modal fade" id="agreagar_detalle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('detalle_cotizacion.crear') }}" method="POST">
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
                                    <label for="recipient-name" class="col-form-label">Categor??a</label>
                                    <select name="IdCategoria" id="IdCategoria" style="width: 95%" class="form-control"
                                        onchange="cambio()" required>
                                        <option style="display: none" value="">Seleccione una categor??a</option>
                                        @foreach ($categoria as $cat)
                                            <option value="{{ $cat->id }}"
                                                @if (old('IdCategoria') == $cat->id) @selected(true) @endif>
                                                {{ $cat->NombreDeLaCategor??a }}</option>
                                        @endforeach
                                    </select>
                                </div>
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

                                        // A??adiendo texto al elemento (opt)
                                        opt.innerHTML = "{{ $p->NombreDelProducto }}";

                                        //A??adiendo un valor al elemento (opt)
                                        opt.value = "{{ $p->id }}";

                                        // A??adiendo opt al final del selector (sel)
                                        selectnw.appendChild(opt);

                                    }
                                @endforeach

                                @foreach ($presentacion as $p)
                                    if ({{ $p->categoria_id }} == valor) {

                                        // creando la nueva option
                                        var opt = document.createElement('option');

                                        // A??adiendo texto al elemento (opt)
                                        opt.innerHTML = "{{ $p->informacion }}";

                                        //A??adiendo un valor al elemento (opt)
                                        opt.value = "{{ $p->id }}";

                                        // A??adiendo opt al final del selector (sel)
                                        selectpw.appendChild(opt);

                                    }
                                @endforeach

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
                                    <label for="recipient-name" class="col-form-label">Presentaci??n</label>
                                    <select name="IdPresentacion" id="IdPresentacion" style="width: 100%"
                                        class="form-control" onchange="precio()" required>
                                        @if (old('IdPresentacion'))
                                            @foreach ($presentacion as $pre)
                                                @if (old('IdPresentacion') == $pre->id)
                                                    <option style="display: none" value="{{ old('IdPresentacion') }}">
                                                        {{ $pre->informacion }}</option>
                                                @endif
                                            @endforeach
                                        @else
                                            <option style="display: none" value="">Seleccione una presentaci??n
                                            </option>
                                        @endif

                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label style="width: 100%" for="">Existencia</label>
                                    <input style="width: 100%" type="text" name="Existencia" class="form-control"
                                        value="{{ old('Existencia', 0) }}" id="Existencia" readonly>
                                </div>
                            </div>


                        </div>

                        <script>
                            function precio() {
                                var select = document.getElementById("IdPresentacion");
                                var valor = select.value;
                                var select1 = document.getElementById("IdProducto");
                                var valor1 = select1.value;

                                document.getElementById("Precio_venta").value = 0;
                                document.getElementById("Existencia").value = 0;

                                @foreach ($precios as $p)
                                    if ({{ $p->IdProducto }} == valor1 && {{ $p->IdPresentaci??n }} == valor) {
                                        document.getElementById("Precio_venta").value = '{{ $p->Precio }}';

                                    }
                                @endforeach

                                @foreach ($inventarios as $i)
                                    if ({{ $i->IdProducto }} == valor1 && {{ $i->IdPresentacion }} == valor) {
                                        document.getElementById("Existencia").value = '{{ $i->Existencia }}';
                                        document.getElementById("Cantidad").max = '{{ $i->Existencia }}';

                                    }
                                @endforeach

                            }
                        </script>

                        <div class="row" style="width: 100%">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label style="width: 100%" for="">Precio de venta</label>
                                    <input style="width: 100%" type="text" readonly name="Precio_venta"
                                        class="form-control {{ $errors->has('Cantidad') ? 'is-invalid' : '' }}"
                                        value="{{ old('Precio_venta', 0) }}" id="Precio_venta"
                                        title="Ingrese el Precio de venta">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label style="width: 100%" for="">Cantidad</label>
                                    <!-- 57. Correccion de la cantidad de agregar detalles de cotizaciones de los clientes  -->
                                    <input style="width: 100%" type="text" name="Cantidad"
                                        class="form-control {{ $errors->has('Cantidad') ? 'is-invalid' : '' }}"
                                        value="{{ old('Cantidad') }}" id="Cantidad" required placeholder="0"
                                        title="Ingrese cantidad de la compra en n??meros." maxlength="4" pattern="[0-9]+"
                                        min="1" onkeypress="return valideKey(event);">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <input class="form-control" id="calimp" name="calimp"
                                style="width: 95%;text-align: center;color: black" type="text"
                                value="{{ old('calimp'), ' ' }}" readonly>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Agregar a la cotizaci??n</button>
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
                <form action="{{ route('detalle_cotizacion.editar') }}" method="POST">
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
                                    <label for="recipient-name" class="col-form-label">Categor??a</label>
                                    <select name="IdCategoria" id="e_IdCategoria" style="width: 95%"
                                        class="form-control" onchange="e_cambio()" required>
                                        <option style="display: none" value="">Seleccione una categor??a</option>
                                        @foreach ($categoria as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->NombreDeLaCategor??a }}</option>
                                        @endforeach
                                    </select>

                                    <input type="text" name="IdDetalle" id="e_IdDetalle" hidden>
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

                                        // A??adiendo texto al elemento (opt)
                                        opt.innerHTML = "{{ $p->NombreDelProducto }}";

                                        //A??adiendo un valor al elemento (opt)
                                        opt.value = "{{ $p->id }}";

                                        // A??adiendo opt al final del selector (sel)
                                        selectnw.appendChild(opt);

                                    }
                                @endforeach

                                @foreach ($presentacion as $p)
                                    if ({{ $p->categoria_id }} == valor) {

                                        // creando la nueva option
                                        var opt = document.createElement('option');

                                        // A??adiendo texto al elemento (opt)
                                        opt.innerHTML = "{{ $p->informacion }}";

                                        //A??adiendo un valor al elemento (opt)
                                        opt.value = "{{ $p->id }}";

                                        // A??adiendo opt al final del selector (sel)
                                        selectpw.appendChild(opt);

                                    }
                                @endforeach

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
                                    <label for="recipient-name" class="col-form-label">Presentaci??n</label>
                                    <select name="IdPresentacion" id="e_IdPresentacion" style="width: 100%"
                                        class="form-control" onchange="e_precio()" required>
                                        <option style="display: none" value="">Seleccione una presentaci??n</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label style="width: 100%" for="">Existencia</label>
                                    <input style="width: 100%" type="text" name="Existencia" class="form-control"
                                        value="0" id="e_Existencia" disabled>
                                </div>
                            </div>
                        </div>

                        <script>
                            function e_precio() {
                                var select = document.getElementById("e_IdPresentacion");
                                var valor = select.value;
                                var select1 = document.getElementById("e_IdProducto");
                                var valor1 = select1.value;

                                document.getElementById("e_Precio_venta").value = 0;
                                document.getElementById("e_Existencia").value = 0;

                                @foreach ($precios as $p)
                                    if ({{ $p->IdProducto }} == valor1 && {{ $p->IdPresentaci??n }} == valor) {
                                        document.getElementById("e_Precio_venta").value = '{{ $p->Precio }}';
                                    }
                                @endforeach

                                @foreach ($inventarios as $i)
                                    if ({{ $i->IdProducto }} == valor1 && {{ $i->IdPresentacion }} == valor) {
                                        document.getElementById("e_Existencia").value = '{{ $i->Existencia }}';
                                        document.getElementById("e_Cantidad").max = '{{ $i->Existencia }}';

                                    }
                                @endforeach

                            }
                        </script>

                        <div class="row" style="width: 100%">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label style="width: 100%" for="">Precio de venta</label>
                                    <input style="width: 100%" type="number" readonly name="Precio_venta"
                                        class="form-control" value="0" id="e_Precio_venta"
                                        title="Ingrese el Precio de venta">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label style="width: 100%" for="">Cantidad</label>
                                    <input style="width: 100%" type="text" name="Cantidad"
                                        class="form-control {{ $errors->has('Cantidad') ? 'is-invalid' : '' }}"
                                        value="{{ old('Cantidad') }}" id="e_Cantidad" required placeholder="0"
                                        title="Ingrese cantidad de la compra en n??meros." maxlength="4" pattern="[0-9]+"
                                        min="1" onkeypress="return valideKey(event);">
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
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>


@endsection

@section('js')
    @push('alertas')
    <script type="text/javascript"> 
        function valideKey(evt){    
            // code is the decimal ASCII representation of the pressed key.
                var code = (evt.which) ? evt.which : evt.keyCode;
            if(code==8) { // backspace.
                return true;
            } else if(code>=48 && code<=57) { // is a number.
                return true;
            } else{ // other keys.
                return false;
            }
        }
    </script>
        <script>
            function editar_detalle(IdProducto, categoria_id, IdPresentacion, Cantidad, Precio_venta, id) {
                $('#e_IdCategoria').val(categoria_id);
                e_cambio();
                $('#e_IdProducto').val(IdProducto);
                $('#e_IdPresentacion').val(IdPresentacion);
                e_impuesto();
                e_precio();
                // $('#e_Precio_venta').val(Precio_venta);
                $('#e_Cantidad').val(Cantidad);
                $('#e_IdDetalle').val(id);

            }

            function limpiarVenta() {
                Swal.fire({
                    title: '??Est?? seguro que desea limpiar los datos de esta cotizaci??n?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '/cotizaciones/limpiar';

                    }

                })

            }
        </script>
    @endpush
@endsection
