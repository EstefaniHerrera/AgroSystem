<?php

use App\Http\Controllers\PersonalController;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\CotizacionController;
use App\Http\Controllers\DetalleCompraController;
use App\Http\Controllers\DetallesCotizacionController;
use App\Http\Controllers\DetalleVentaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\PedidosClientesController;
use App\Http\Controllers\RangoController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\DetallesPedidosClientesController;
use App\Http\Controllers\DetallesPedidosProductosNuevosController;
use App\Http\Controllers\DetallesPedidosProveedorController;
use App\Http\Controllers\FacturasVencerController;
use App\Http\Controllers\GastoController;
use App\Http\Controllers\PedidosProductosNuevosController;
use App\Http\Controllers\PedidosProveedorController;
use App\Http\Controllers\ProductosVencerController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\DevolucionClienteDetalleController;
use App\Http\Controllers\DevolucionClienteController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/********************************* INICIO DE SESION *********************************/
Route::view('/', 'Plantillas.PantallaBienvenida');

Route::get('/usuarios/cambiar_contrasena', [UserController::class, 'cambiar_contrasena'])
    ->name('usuarios.cambiar_contrasena');

Route::post('usuarios/update_contrasena', [ResetPasswordController::class, 'update_contrasena'])
    ->name('usuarios.update_contrasena');

Auth::routes();
Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/principal', function () {
        return view('plantillas.PantallaPrincipal');
    });

/********************************* PERSONAL *********************************/

Route::get('/personals', [PersonalController::class, 'index'])
->name('personal.index');

Route::get('/personals/buscar', [PersonalController::class, 'index2'])
->name('personal.index2');

    Route::get('/personals/{id}', [PersonalController::class, 'show'])
    ->name('personal.mostrar')->where('id', '[0-9]+');

    Route::get('/personals/crear', [PersonalController::class, 'crear'])
    ->name('personal.crear');

    Route::post('/personals/crear', [PersonalController::class, 'store'])
    ->name('personal.guardar');

    Route::get('/personals/{id}/editar', [PersonalController::class, 'edit'])
    ->name('personal.edit')->where('id', '[0-9]+');

    Route::put('/personals/{id}/editar', [PersonalController::class, 'update'])
    ->name('personal.update')->where('id', '[0-9]+');

    Route::get('/estado/{id}', [PersonalController::class, 'updateStatus'])
     ->name('status.update')->where('id', '[0-9]+');


    /********************************* CARGO *********************************/

    Route::get('/cargos', [CargoController::class, 'index'])
    ->name('cargo.index');

    Route::get('/cargos2', [CargoController::class, 'index2'])
    ->name('cargo.index2');

    Route::get('/cargos/crear', [CargoController::class, 'crear'])
    ->name('cargo.crear');

    Route::post('/cargos/crear', [CargoController::class, 'store'])
    ->name('cargo.guardar');

    Route::get('/cargos/{id}/editar', [CargoController::class, 'edit'])
    ->name('cargo.edit')->where('id', '[0-9]+');

    Route::put('/cargos/{id}/editar', [CargoController::class, 'update'])
    ->name('cargo.update')->where('id', '[0-9]+');


    /********************************* PROVEEDOR *********************************/

    Route::get('/proveedors', [ProveedorController::class, 'index'])
    ->name('proveedor.index');

    Route::get('/proveedors/buscar', [ProveedorController::class, 'index2'])
    ->name('proveedor.index2');

    Route::get('/proveedors/crear', [ProveedorController::class, 'crear'])
    ->name('proveedor.crear');

    Route::post('/proveedors/crear', [ProveedorController::class, 'store'])
    ->name('proveedor.guardar');

    Route::get('/proveedors/crear2', [ProveedorController::class, 'crear2'])
    ->name('proveedor.crear2');

    Route::post('/proveedors/crear2', [ProveedorController::class, 'store2'])
    ->name('proveedor.guardar2');

    Route::get('/proveedors/crear3', [ProveedorController::class, 'crear3'])
    ->name('proveedor.crear3');

    Route::post('/proveedors/crear3', [ProveedorController::class, 'store3'])
    ->name('proveedor.guardar3');

    Route::get('/proveedors/{id}', [ProveedorController::class, 'show'])
    ->name('proveedor.mostrar')->where('id', '[0-9]+');

    Route::get('/proveedors/{id}/editar', [ProveedorController::class, 'edit'])
    ->name('proveedor.edit')->where('id', '[0-9]+');

    Route::put('/proveedors/{id}/editar', [ProveedorController::class, 'update'])
    ->name('proveedor.update')->where('id', '[0-9]+');


    /********************************* CLIENTE *********************************/

    Route::get('/clientes', [ClienteController::class, 'index'])
    ->name('cliente.index');

    Route::get('/clientes/buscar', [clienteController::class, 'index2'])
    ->name('cliente.index2');

    Route::get('/clientes/crear', [ClienteController::class, 'crear'])
    ->name('cliente.crear');

    Route::post('/clientes/guardar', [ClienteController::class, 'store'])
    ->name('cliente.guardar');

    Route::get('/clientes/crear2', [ClienteController::class, 'crear2'])
    ->name('cliente.crear2');

    Route::post('/clientes/guardar2', [ClienteController::class, 'store2'])
    ->name('cliente.guardar2');

    Route::get('/clientes/crear3', [ClienteController::class, 'crear3'])
    ->name('cliente.crear3');

    Route::post('/clientes/guardar3', [ClienteController::class, 'store3'])
    ->name('cliente.guardar3');

    Route::get('/clientes/crear4', [ClienteController::class, 'crear4'])
    ->name('cliente.crear4');

    Route::post('/clientes/guardar4', [ClienteController::class, 'store4'])
    ->name('cliente.guardar4');

    Route::get('/clientes/{id}', [ClienteController::class, 'show'])
    ->name('cliente.mostrar')->where('id', '[0-9]+');

    Route::get('/clientes/{id}/edit', [ClienteController::class, 'edit'])
    ->name('cliente.edit')->where('id', '[0-9]+');

    Route::put('/clientes/{id}/editar', [ClienteController::class, 'update'])
    ->name('cliente.update')->where('id', '[0-9]+');


    /********************************* CATEGORIAS *********************************/

    Route::get('/categorias', [CategoriaController::class, 'index'])
    ->name('categoria.index');

    Route::get('/categorias/buscar', [CategoriaController::class, 'index2'])
    ->name('categoria.index2');

    Route::get('/categorias/crear', [CategoriaController::class, 'crear'])
    ->name('categoria.crear');

    Route::post('/categorias/guardar', [CategoriaController::class, 'store'])
    ->name('categoria.guardar');

    Route::get('/categorias/crear2', [CategoriaController::class, 'crear2'])
    ->name('categoria.crear2');

    Route::post('/categorias/guardar2', [CategoriaController::class, 'store2'])
    ->name('categoria.guardar2');

    Route::get('/categorias/{id}/editar', [CategoriaController::class, 'edit'])
    ->name('categoria.edit')->where('id', '[0-9]+');

    Route::put('/categorias/{id}/editar', [CategoriaController::class, 'update'])
    ->name('categoria.update')->where('id', '[0-9]+');


    /********************************* PRODUCTOS *********************************/

    Route::get('/productos', [ProductoController::class, 'index'])
    ->name('producto.index');

    Route::get('/productos/buscar', [ProductoController::class, 'index2'])
    ->name('producto.index2');

    Route::get('/productos/crear', [ProductoController::class, 'crear'])
    ->name('producto.crear');

    Route::post('/productos/crear', [ProductoController::class, 'store'])
    ->name('producto.guardar');

    Route::get('/productos/crear2', [ProductoController::class, 'crear2'])
    ->name('producto.crear2');

    Route::post('/productos/crear2', [ProductoController::class, 'store2'])
    ->name('producto.guardar2');

    Route::get('/productos/{id}/editar', [ProductoController::class, 'edit'])
    ->name('producto.edit')->where('id', '[0-9]+');

    Route::put('/productos/{id}/editar', [ProductoController::class, 'update'])
    ->name('producto.update')->where('id', '[0-9]+');

    Route::get('/productos/{id}', [ProductoController::class, 'show'])
    ->name('producto.mostrar')->where('id', '[0-9]+');


    /********************************* COMPRAS y REPORTE *********************************/

    // #40. Correcci??n al llenar la factura.
    Route::get('/compras/crear/{numerCompra?}/{proveedorId?}/{fechaPago?}/{fechaCompra?}/{tipoPago?}/',[CompraController::class, 'create'])
    ->name('compras.crear');

    Route::get('/compras/limpiar',[CompraController::class, 'limpiar'])
    ->name('compras.limpir');

    Route::get('/compras', [CompraController::class, 'index'])
    ->name('compras.index');

    Route::get('/compras/reporte', [CompraController::class, 'reporte'])
    ->name('compras.reporte');

    Route::get('/compras/{id}', [CompraController::class, 'show'])
    ->name('compras.mostrar');

    Route::get('/compras2/{id}', [CompraController::class, 'show2'])
    ->name('compra.mostrar');

    Route::post('/compras/guardar', [CompraController::class, 'store'])
    ->name('compras.guardar');

    Route::get('/compras/pdf/{anio1}/{anio2}/{proveeforR}', [CompraController::class, 'pdf'])
    ->name('compras.pdf');


    /******************************* DETALLE COMPRAS *******************************/

    Route::post('/detalle_compra/agregar', [DetalleCompraController::class, 'agregar_detalle'])
    ->name('detalle_compra.crear');

    Route::get('/detalle_compra/eliminar/{DetalleCompra}', [DetalleCompraController::class, 'destroy'])
    ->name('detalle_compra.eliminar');

    Route::post('/detalle_compra/editar', [DetalleCompraController::class, 'agregar_detalle_edit'])
    ->name('detalle_compra.editar');


    /********************************* INVENTARIO *********************************/

    Route::get('/inventario', [InventarioController::class, 'index'])
    ->name('inventario.index');

    Route::get('/inventario/buscar', [InventarioController::class, 'index2'])
    ->name('inventario.index2');

    Route::get('/inventario/precios/{id}/{presentacion}', [InventarioController::class, 'precios'])
    ->name('inventario.precio')->where('id', '[0-9]+');

    Route::get('/inventario/detalles/{id}/{presentacion}', [InventarioController::class, 'detalles'])
    ->name('inventario.detalle')->where('id', '[0-9]+');


    /********************************* VENTAS *********************************/

    Route::get('/ventas/crear/{clientepedido}',[VentaController::class, 'create'])
    ->name('ventas.crear');

    Route::get('/ventas/limpiar/{cliente}',[VentaController::class, 'limpiar'])
    ->name('ventas.limpir');

    Route::post('/ventas/guardar', [VentaController::class, 'store'])
    ->name('ventas.guardar');

    Route::get('/ventas', [VentaController::class, 'index'])
    ->name('ventas.index');

    Route::get('/ventas/reporte', [VentaController::class, 'reporte'])
    ->name('ventas.reporte');

    Route::get('/ventas/{id}', [VentaController::class, 'show'])
    ->name('ventas.mostrar');

    Route::get('/ventas/pdf/{anio1}/{anio2}/{clientes?}/{empleados}', [VentaController::class, 'pdf'])
    ->name('ventas.pdf');


    /******************************* DETALLE VENTAS *******************************/

    Route::post('/detalle_venta/agregar', [DetalleVentaController::class, 'agregar_detalle'])
    ->name('detalle_venta.crear');

    Route::get('/detalle_venta/eliminar/{DetalleCompra}/{cliente}', [DetalleVentaController::class, 'destroy'])
    ->name('detalle_venta.eliminar');

    Route::post('/detalle_venta/editar', [DetalleVentaController::class, 'agregar_detalle_edit'])
    ->name('detalle_venta.editar');

    Route::post('/rango/agregar', [RangoController::class, 'agregar_detalle'])
    ->name('rango.crear');


    /******************************* PEDIDOS CLIENTES *******************************/

    Route::get('/pedidosClientes', [PedidosClientesController::class, 'index'])
    ->name('pedidosCliente.index');

    Route::get('/pedidosClientes/detalle/{id}', [PedidosClientesController::class, 'show'])
    ->name('pedidosCliente.show');

    // 59 y 60. Correccion de mantener cliente al agregar y editar detalles
    Route::get('/pedidosClientes/crear/{idCliente?}', [PedidosClientesController::class, 'create'])
    ->name('pedidosCliente.crear');

    Route::post('/pedidos/crear', [PedidosClientesController::class, 'store'])
    ->name('pedidosCliente.guardar');

    Route::get('/pedidosCliente/limpiar',[PedidosClientesController::class, 'limpiar'])
    ->name('pedidosCliente.limpiar');

    Route::get('/estadoP/{id}', [PedidosClientesController::class, 'updateStatus'])
    ->name('status.update')->where('id', '[0-9]+');

    Route::get('/destroy/{id}', [PedidosClientesController::class, 'eliminar'])
    ->name('status.destroy')->where('id', '[0-9]+');

    //PARA EDITAR

    Route::get('/pedidosClientes/{id}/editar', [PedidosClientesController::class, 'edit'])
    ->name('pedidosClientes.edit')->where('id', '[0-9]+');

    Route::post('/pedidosClientes/{id}/editar', [PedidosClientesController::class, 'update'])
    ->name('pedidosClientes.update')->where('id', '[0-9]+');

    Route::get('/pedidosClientes/restaurar/{id}',[PedidosClientesController::class, 'restaurar'])
    ->name('pedidosClientes.restaurar')->where('id', '[0-9]+');

    Route::get('/pedidosClientes/cerrar',[PedidosClientesController::class, 'cerrar'])
    ->name('pedidosClientes.cerrar');


    /******************************* DETALLE PEDIDO CLIENTES *******************************/

    Route::post('/detalle_pedidosCliente/agregar', [DetallesPedidosClientesController::class, 'agregar_detalle'])
    ->name('detalle_pedidosCliente.crear');

    Route::get('/detalle_pedidosCliente/eliminar/{DetalleCompra}', [DetallesPedidosClientesController::class, 'destroy'])
    ->name('detalle_pedidosCliente.eliminar');

    Route::post('/detalle_pedidosCliente/editar', [DetallesPedidosClientesController::class, 'agregar_detalle_edit'])
    ->name('detalle_pedidosCliente.editar');

    //Rutas para editar detalls de actualizar venta Mj
    Route::post('/detalle_pedidosCliente/agregar/{DetalleCompra}/edit', [DetallesPedidosClientesController::class, 'edit_agregar_detalle'])
    ->name('detalle_pedidosCliente.crear2');

    Route::get('/detalle_pedidosCliente/eliminar/{DetalleCompra}/{edit}', [DetallesPedidosClientesController::class, 'destroy2'])
    ->name('detalle_pedidosCliente.eliminar2');

    Route::post('/detalle_pedidosCliente/editar/{DetalleCompra}/editar', [DetallesPedidosClientesController::class, 'edit_agregar_detalle_edit'])
    ->name('detalle_pedidosCliente.editar2');


    /******************************* PEDIDOS PRODUCTOS NUEVOS CLIENTES *******************************/

    Route::get('/pedidosProductoNuevoClientes', [PedidosProductosNuevosController::class, 'index'])
    ->name('pedidosClienteP.index');

    Route::get('/pedidosProductoNuevoClientes/detalle/{id}', [PedidosProductosNuevosController::class, 'show'])
    ->name('pedidosClienteP.show');

    Route::get('/pedidosProductoNuevoClientes/crear/{clien?}/{anticipo?}', [PedidosProductosNuevosController::class, 'create'])
    ->name('pedidosClienteP.crear');

    Route::post('/pedidosProductoNuevo/crear', [PedidosProductosNuevosController::class, 'store'])
    ->name('pedidosClienteP.guardar');

    Route::get('/pedidosProductoNuevoCliente/limpiar',[PedidosProductosNuevosController::class, 'limpiar'])
    ->name('pedidosClienteP.limpiar');

    Route::get('/estadoPPN/{id}', [PedidosProductosNuevosController::class, 'updateStatus'])
    ->name('status.update')->where('id', '[0-9]+');

    Route::get('/pedidosProductoNuevoCliente/{id}/editar', [PedidosProductosNuevosController::class, 'edit'])
    ->name('pedidosClienteP.edit')->where('id', '[0-9]+');

    Route::post('/pedidosProductoNuevoCliente/{id}/editar', [PedidosProductosNuevosController::class, 'update'])
    ->name('pedidosClienteP.update')->where('id', '[0-9]+');

    Route::get('/pedidosProductoNuevoCliente/restaurar/{id}',[PedidosProductosNuevosController::class, 'restaurar'])
    ->name('pedidosClienteP.restaurar')->where('id', '[0-9]+');

    Route::get('/pedidosProductoNuevoCliente/cerrar',[PedidosProductosNuevosController::class, 'cerrar'])
    ->name('pedidosClienteP.cerrar');


    /******************************* DETALLE PEDIDO PRODUCTOS NUEVOS CLIENTES *******************************/

    Route::post('/detalle_pedidosProductoNuevoCliente/agregar', [DetallesPedidosProductosNuevosController::class, 'agregar_detalle'])
    ->name('detalle_pedidosClienteP.crear');

    Route::get('/detalle_pedidosProductoNuevoCliente/eliminar/{Detallepedido}', [DetallesPedidosProductosNuevosController::class, 'destroy'])
    ->name('detalle_pedidosClienteP.eliminar');

    Route::post('/detalle_pedidosProductoNuevoCliente/editar', [DetallesPedidosProductosNuevosController::class, 'agregar_detalle_edit'])
    ->name('detalle_pedidoP.editar');

    Route::post('/detalle_pedidosProductoNuevoCliente/agregar/{DetalleCompra}/edit', [DetallesPedidosProductosNuevosController::class, 'edit_agregar_detalle'])
    ->name('detalle_pedidosClienteP.crear2');

    Route::get('/detalle_pedidosProductoNuevoCliente/eliminar/{DetalleCompra}/{edit}', [DetallesPedidosProductosNuevosController::class, 'destroy2'])
    ->name('detalle_pedidosClienteP.eliminar2');

    Route::post('/detalle_pedidosProductoNuevoCliente/editar/{DetalleCompra}/editar', [DetallesPedidosProductosNuevosController::class, 'edit_agregar_detalle_edit'])
    ->name('detalle_pedidosClienteP.editar2');


    /******************************* FACTURAS PROXIMAS A VENCER *******************************/

    Route::get('/compra', [FacturasVencerController::class, 'index'])
    ->name('compra.index');

    Route::get('/compra/reporte', [FacturasVencerController::class, 'reporte'])
    ->name('compra.reporte');


    /******************************* PRODUCTOS PROXIMOS A VENCER *******************************/

    Route::get('/Inventarios', [ProductosVencerController::class, 'index'])
    ->name('Inventarios.index');

    Route::get('/Inventarios/buscar', [ProductosVencerController::class, 'index2'])
    ->name('Inventarios.index2');


    /******************************* COTIZACIONES Y DETALLES DE LAS COTIZACIONES *******************************/

    Route::get('/cotizaciones/crear',[CotizacionController::class, 'create'])
    ->name('cotizaciones.crear');

    Route::post('/cotizaciones/guardar', [CotizacionController::class, 'store'])
    ->name('cotizaciones.guardar');

    Route::get('/cotizaciones/limpiar',[CotizacionController::class, 'limpiar'])
    ->name('cotizaciones.limpir');

    Route::get('/cotizaciones/{id}', [CotizacionController::class, 'show'])
    ->name('cotizaciones.mostrar');

    Route::post('/detalle_cotizacion/agregar', [DetallesCotizacionController::class, 'agregar_detalle'])
    ->name('detalle_cotizacion.crear');

    Route::get('/detalle_cotizacion/eliminar/{DetalleCotizacion}', [DetallesCotizacionController::class, 'destroy'])
    ->name('detalle_cotizacion.eliminar');

    Route::post('/detalle_cotizacion/editar', [DetallesCotizacionController::class, 'agregar_detalle_edit'])
    ->name('detalle_cotizacion.editar');


    /******************************* PEDIDOS PROVEEDOR *******************************/

    Route::get('/pedidosProveedor', [PedidosProveedorController::class, 'index'])
    ->name('pedidosProveedor.index');

    Route::get('/pedidosProveedor/detalle/{id}', [PedidosProveedorController::class, 'show'])
    ->name('pedidosProveedor.show');

    //<!-- 62 y 63. Correcci??n de mantener proveedor al agregar y editar detalles -->

    Route::get('/pedidosProveedor/crear/{idProveedorss?}', [PedidosProveedorController::class, 'create'])
    ->name('pedidosProveedor.crear');

    Route::post('/pedidosP/crear', [PedidosProveedorController::class, 'store'])
    ->name('pedidosProveedor.guardar');

    Route::get('/pedidosProveedor/limpiar',[PedidosProveedorController::class, 'limpiar'])
    ->name('pedidosProveedor.limpiar');

    Route::get('/estadoProveedor/{id}', [PedidosProveedorController::class, 'updateStatus'])
    ->name('status.update')->where('id', '[0-9]+');

    Route::get('/destroyPro/{id}', [PedidosProveedorController::class, 'eliminar'])
    ->name('status.destroy')->where('id', '[0-9]+');

    Route::get('/pedidosProveedor/{id}/editar', [PedidosProveedorController::class, 'edit'])
    ->name('pedidosProveedor.edit')->where('id', '[0-9]+');

    Route::post('/pedidosProveedor/{id}/editar', [PedidosProveedorController::class, 'update'])
    ->name('pedidosProveedor.update')->where('id', '[0-9]+');

    Route::get('/pedidosProveedor/restaurar/{id}',[PedidosProveedorController::class, 'restaurar'])
    ->name('pedidosProveedor.restaurar')->where('id', '[0-9]+');

    Route::get('/pedidosProveedor/cerrar',[PedidosProveedorController::class, 'cerrar'])
    ->name('pedidosProveedor.cerrar');

    /******************************* DETALLE PEDIDO PROVEEDOR *******************************/

    Route::post('/detalle_pedidosProveedor/agregar', [DetallesPedidosProveedorController::class, 'agregar_detalle'])
    ->name('detalle_pedidosProveedor.crear');

    Route::get('/detalle_pedidosProveedor/eliminar/{DetalleCompra}', [DetallesPedidosProveedorController::class, 'destroy'])
    ->name('detalle_pedidosProveedor.eliminar');

    Route::post('/detalle_pedidosProveedor/editar', [DetallesPedidosProveedorController::class, 'agregar_detalle_edit'])
    ->name('detalle_pedidosProveedor.editar');

    Route::post('/detalle_pedidosProveedor/agregar/{DetalleCompra}/edit', [DetallesPedidosProveedorController::class, 'edit_agregar_detalle'])
    ->name('detalle_pedidosProveedor.crear2');

    Route::get('/detalle_pedidosProveedor/eliminar/{DetalleCompra}/{edit}', [DetallesPedidosProveedorController::class, 'destroy2'])
    ->name('detalle_pedidosProveedor.eliminar2');

    Route::post('/detalle_pedidosProveedor/editar/{DetalleCompra}/editar', [DetallesPedidosProveedorController::class, 'edit_agregar_detalle_edit'])
    ->name('detalle_pedidosProveedor.editar2');


    /******************************* SERVICIO TECNICO *******************************/

    Route::get('/Servicio', [ServicioController::class, 'index'])
    ->name('servicio.index');

    Route::get('/Servicio/buscar', [ServicioController::class, 'index2'])
    ->name('servicio.index2');

    Route::get('/Servicio/{id}', [ServicioController::class, 'show'])
    ->name('servicio.mostrar')->where('id', '[0-9]+');

    Route::get('/Servicio/crear', [ServicioController::class, 'crear'])
    ->name('servicio.crear');

    Route::post('Servicior/crear', [ServicioController::class, 'store'])
    ->name('servicio.guardar');

    Route::get('/Servicio/{id}/editar', [ServicioController::class, 'edit'])
    ->name('servicio.edit')->where('id', '[0-9]+');

    Route::put('/Servicio/{id}/editar', [ServicioController::class, 'update'])
    ->name('servicio.update')->where('id', '[0-9]+');

    Route::get('/estadoS/{id}', [ServicioController::class, 'updateStatus'])
    ->name('status.update')->where('id', '[0-9]+');


    /******************************* GASTOS *******************************/

    Route::get('/gasto', [GastoController::class, 'index'])
    ->name('gasto.index');

    Route::get('/gasto/crear', [GastoController::class, 'create'])
    ->name('gasto.crear');

    Route::post('gasto/crear', [GastoController::class, 'store'])
    ->name('gasto.guardar');

    Route::get('/gasto/{id}/editar', [GastoController::class, 'edit'])
    ->name('gasto.edit')->where('id', '[0-9]+');

    Route::put('/gasto/{id}/editar', [GastoController::class, 'update'])
    ->name('gasto.mostrar')->where('id', '[0-9]+');

    Route::get('/gasto/{id}', [GastoController::class, 'show'])
    ->name('gasto.update')->where('id', '[0-9]+');

    Route::get('/gasto/reporte', [GastoController::class, 'reporte'])
    ->name('gasto.reporte');

    Route::get('/gasto/pdf/{anio1}/{anio2}/{tipo}/{empleado}', [GastoController::class, 'pdf'])
    ->name('gasto.pdf');


    /********************************* DEVOLUCIONES CLIENTES  *********************************/

    Route::get('/devolucioncliente/crear/{clientepedido}/',[DevolucionClienteController::class, 'create'])
    ->name('devolucioncliente.crear');

    Route::get('/devolucioncliente/limpiar/{cliente}',[DevolucionClienteController::class, 'limpiar'])
    ->name('devolucioncliente.limpir');

    Route::post('/devolucioncliente/guardar', [DevolucionClienteController::class, 'store'])
    ->name('devolucioncliente.guardar');

    Route::get('/devolucioncliente/cerrar',[DevolucionClienteController::class, 'cerrar'])
    ->name('devolucioncliente.cerrar');

    Route::get('/devolucioncliente/reporte', [DevolucionClienteController::class, 'reporte'])
    ->name('devolucioncliente.reporte');

    Route::get('/devolucioncliente/{id}', [DevolucionClienteController::class, 'show'])
    ->name('devolucioncliente.mostrar');

    Route::get('/devolucioncliente',[DevolucionClienteController::class, 'index'])
    ->name('devolucioncliente.index');


    /******************************* DETALLES DEVOLUCIONES CLIENTES *******************************/

    Route::post('/detalle_devolucioncliente/agregar/{IdDevolucion}', [DevolucionClienteDetalleController::class, 'agregar_detalle'])
    ->name('detalle_devolucioncliente.crear')->where('IdDevolucion', '[0-9]+');


    /********************************* CATALOGO *********************************/

    Route::get('/catalogo', [CatalogoController::class, 'index'])
    ->name('catalogo.index');

    Route::get('/catalogo/crear', [CatalogoController::class, 'crear'])
    ->name('catalogo.crear');

    Route::post('catalogo/crear', [CatalogoController::class, 'store'])
    ->name('catalogo.guardar');

    Route::get('/catalogo/{id}/editar', [CatalogoController::class, 'edit'])
    ->name('catalogo.edit')->where('id', '[0-9]+');

    Route::put('/catalogo/{id}/editar', [CatalogoController::class, 'update'])
    ->name('catalogo.update')->where('id', '[0-9]+');

    Route::get('/catalogo/buscar', [CatalogoController::class, 'buscar'])
    ->name('catalogo.buscar');

    Route::get('/destroyCatalogo/{id}', [CatalogoController::class, 'eliminar'])
    ->name('status.destroy')->where('id', '[0-9]+');


    /********************************* USUARIOS *********************************/

    Route::get('/usuarios', [UserController::class, 'index'])
    ->name('usuarios.index');

    Route::get('/usuarios/buscar', [UserController::class, 'index2'])
    ->name('usuarios.index2');

    Route::get('/usuarios/crear', [UserController::class, 'create'])
    ->name('usuarios.crear');

    Route::post('/usuarios/crear', [UserController::class, 'store'])
    ->name('usuarios.guardar');

    Route::get('/usuarios/cambiar_contrasena2', [UserController::class, 'cambiar_contrasena2'])
    ->name('usuarios.cambiar_contrasena2');

    Route::post('usuarios/update_contrasena2/{user}', [ResetPasswordController::class, 'update_contrasena2'])
    ->name('usuarios.update_contrasena2');

    Route::get('/destroyUsuario/{id}', [UserController::class, 'eliminar'])
    ->name('usuarios.destroy')->where('id', '[0-9]+');

 });
