<?php

namespace App\Http\Controllers;

use App\Models\DevolucionCliente;
use App\Models\DevolucionClienteDetalle;
use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\DetallesTemporal;
use App\Models\DetalleVenta;
use App\Models\Inventario;
use App\Models\Personal;
use App\Models\Precio;
use App\Models\Presentacion;
use App\Models\Producto;
use App\Models\Rango;
use App\Models\Venta;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DevolucionClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(){
        $clien = 0;
        $empleado = 0;
        $fechadesde = "";
        $fechahasta = "";
        $clientes = Cliente::all();
        $personal = Personal::all();

        $ventas = DevolucionCliente::paginate(10);
        foreach ($ventas as $key => $value) {
            if ($value->cliente_id != null) {
                $value->clientes = Cliente::findOrFail($value->cliente_id);
            }
            $value->persona = Personal::findOrFail($value->devolucion_personal_id);
        }

        return view('devolucioncliente.index', compact('clientes', 'ventas', 'personal', 'fechadesde', 'fechahasta', 
        'clien', 'empleado'));
    }


    public function reporte(Request $request) {

        $clientes = Cliente::all();
        $personal = Personal::all();
        $clien = $request->get('cliente');
        $empleado = $request->get('empleado');
        $fechadesde = $request->get('FechaDesde');
        $fechahasta = $request->get('FechaHasta');

            if ($clien == 0 && $empleado == 0) {                    
                if ($fechadesde == '' && $fechahasta == ''){
                    $request->validate([

                    ]);
                    $rules = [
                        'cliente' => 'required|numeric|min:1',
                        'empleado' => 'required|numeric|min:1',
                        'FechaDesde' => 'required',
                        'FechaHasta' => 'required',
                    ];
            
                    $mensaje = [
                        'cliente.min' => 'Seleccione un cliente o',
                        'empleado.min' => 'Seleccione un empleado o',
                        'FechaDesde.required' => 'ingrese una fecha de inicio y',
                        'FechaHasta.required' => 'una fecha de fin',
                    ];
                    $this->validate($request, $rules, $mensaje);
    
                    $fechadesde = '';
                    $fechahasta = ''; 
                } else {
                    $rules = [
                        'FechaDesde' => '',
                        'FechaHasta' => 'after_or_equal:FechaDesde',
                    ];
                    
                    $mensaje = [
                        'FechaHasta.after_or_equal' => 'La fecha hasta debe ser posterior a la fecha desde',
                    ];
                    $this->validate($request, $rules, $mensaje);

                    $ventas = DB::table('devolucion_clientes')
                    ->select('devolucion_clientes.*')
                    ->where('FechaDevolucion', [$fechadesde, $fechahasta])
                    ->paginate(15)->withQueryString();   
                }              
            } else {
                if ($fechadesde == '' && $clien != 0 && $empleado == 0) {
                    if ($clien == 'a') {
                        $clien = null;
                    }

                    $ventas = DevolucionCliente::select('devolucion_clientes.*')
                    ->where('cliente_id', '=', $clien)
                    ->paginate(15)->withQueryString();

                } else if ($fechadesde == '' && $clien == 0 && $empleado != 0) {
                        $ventas = DevolucionCliente::select('devolucion_clientes.*')
                        ->where('devolucion_personal_id', '=', $empleado)
                        ->paginate(15)->withQueryString();

                    } else if ($fechadesde == '' && $clien != 0 && $empleado != 0) {
                        if ($clien == 'a') {
                            $clien = null;
                        }
                        $ventas = DevolucionCliente::select('devolucion_clientes.*')
                        ->whereBetween('devolucion_personal_id', [$empleado, $empleado])
                        ->where('cliente_id', '=', $clien)
                        ->paginate(15)->withQueryString();

                        } else  if ($fechadesde != '' && $clien != 0 && $empleado == 0) {
                            if ($clien == 'a') {
                                $clien = null;
                            }
                            $ventas = DevolucionCliente::select('devolucion_clientes.*')
                            ->whereBetween('FechaDevolucion', [$fechadesde, $fechahasta])
                            ->where('cliente_id', '=', $clien)
                            ->paginate(15)->withQueryString();

                        } else if ($fechadesde != '' && $clien == 0 && $empleado != 0) {
                            $ventas = DevolucionCliente::select('devolucion_clientes.*')
                            ->whereBetween('FechaDevolucion', [$fechadesde, $fechahasta])
                            ->where('devolucion_personal_id', '=', $empleado)
                            ->paginate(15)->withQueryString();
                        } else {
                            if ($clien == 'a') {
                                $clien = null;
                            }

                            $ventas = DevolucionCliente::select('devolucion_clientes.*')
                            ->whereBetween('FechaDevolucion', [$fechadesde, $fechahasta])
                            ->where('devolucion_personal_id', '=', $empleado)
                            ->where('cliente_id', '=', $clien)
                            ->paginate(15)->withQueryString();
                        }
            } 

        foreach ($ventas as $key => $value) {
            if ($value->cliente_id != null) {
                $value->clientes = Cliente::findOrFail($value->cliente_id);
            }
            $value->persona = Personal::findOrFail($value->devolucion_personal_id);
        }

        if ($fechadesde == '') {
            $fechadesde = 0;
        }
        if ($fechahasta == '') {
            $fechahasta = 0;
        } 
        if ($clien == null) {
            $clien = '*';
        }

        return view('devolucioncliente.index', compact('clientes', 'personal', 'ventas', 'fechadesde', 'fechahasta', 'clien', 'empleado'));
    }

    public function create($clientepedido)
    {

        $detallesViejos = DetalleVenta::where('IdVenta', $clientepedido)->get();
        foreach ($detallesViejos  as $key => $value) {
            $existe = DB::table('detalles_temporals')->where('IdVenta', '=', $clientepedido)
                                                            ->where('IdProducto', '=', $value->IdProducto)
                                                            ->where('IdPresentacion', '=', $value->IdPresentacion)->exists();
            
            $exis = DB::table('detalles_temporals')->where('IdVenta', '=', null)
                                                            ->where('IdProducto', '=', $value->IdProducto)
                                                            ->where('IdPresentacion', '=', $value->IdPresentacion)->exists();
            if ($existe == false && $exis == false) {
                $temporal = new DetallesTemporal();
                $temporal->IdVenta = $value->IdVenta;
                $temporal->IdProducto = $value->IdProducto;
                $temporal->IdPresentacion = $value->IdPresentacion;
                $temporal->Cantidad = $value->Cantidad;
                $temporal->Precio_venta = $value->Precio_venta;
                $temporal->save();
            }
        }

        $productos = Producto::all();
        $categoria = Categoria::all();
        $presentacion = Presentacion::all();
        $precios = Precio::all();
        $inventarios = Inventario::all();
        
            $total_cantidad = 0;
            $total_precio = 0;
            $total_impuesto = 0;
            $empleado = Personal::all();
            $cliente = Cliente::all();
            $venta = Venta::findOrFail($clientepedido);
            $clien = '';
            if($venta->cliente_id != null){
                $abc = Cliente::findOrFail($venta->cliente_id);
                $clien = $abc->NombresDelCliente . ' ' . $abc->ApellidosDelCliente;
            }else{
                $clien = 'Consumidor final';
            }
            $per = Personal::findOrFail($venta->personal_id);
            $detalleventa = DetallesTemporal::where('IdVenta', $clientepedido)->get();
            foreach ($detalleventa  as $key => $value) {
                $value->producto = Producto::findOrFail($value->IdProducto);
                $value->presentacion = Presentacion::findOrFail($value->IdPresentacion);
            }
            $detalledevolucion = DevolucionClienteDetalle::where('IdDevolucion', 0)->get();
            foreach ($detalledevolucion  as $key => $value) {
                $value->producto = Producto::findOrFail($value->IdProducto);
                $value->presentacion = Presentacion::findOrFail($value->IdPresentacion);
                $total_cantidad += $value->Cantidad;
                $total_precio += ($value->Cantidad * $value->Precio_venta);
                $produc = Producto::findorFail($value->IdProducto);
                if ($produc->Impuesto == 0.15) {
                    $total_impuesto += ($value->Cantidad * $value->Precio_venta) * 0.15;
                }
            }

            return view('devolucioncliente.create', compact('empleado', 'cliente', 'venta', 'detalleventa', 'detalledevolucion', 
            'total_cantidad', 'total_precio', 'total_impuesto', 'clientepedido', 'clien', 'per'))
            ->with('productos', $productos)
            ->with('presentacion', $presentacion)
            ->with('categoria', $categoria)
            ->with('inventarios', $inventarios)
            ->with('precios', $precios);
    }

    public function store(Request $request)
    {

        $request->validate([
            'NumFactura' => 'required|numeric|min:1',
            'FechaVenta' => 'required|date|before:tomorrow|after:yesterday',
            'descripcion' => 'required',
            'TotalVenta' => 'numeric|min:1.00',
        ], [
            'FechaVenta.before' => 'El campo fecha de venta debe de ser hoy',
            'FechaVenta.after' => 'El campo fecha de venta debe de ser hoy',
            'TotalVenta.min' => 'Seleccione productos a devolver',
            'descripcion.required'=> 'Agregue el motivo por el cual devuelve los productos'
        ]);
        
        $ven = Venta::findOrFail($request->IdVenta);
        $venta = new DevolucionCliente();

        $venta->NumFactura = $ven->NumFactura;
        $venta->vendedor_id = $ven->personal_id;
        $venta->cliente_id = $ven->cliente_id;
        $venta->devolucion_personal_id = $request->input('Empleado');
        $venta->FechaDevolucion = $request->input('FechaVenta');
        $venta->descripcion = $request->input('descripcion');
        $venta->TotalVenta = $request->input('TotalVenta');
        $venta->TotalImpuesto = $request->input('TotalImpuesto');
        $venta->save();

        $ven->TotalVenta = $ven->TotalVenta - $venta->TotalVenta;
        $ven->TotalImpuesto = $ven->TotalImpuesto - $venta->TotalImpuesto;
        $ven->save();

        $detalles =  DevolucionClienteDetalle::where('IdDevolucion', 0)->get();

        $total_cantidad = 0;

        foreach ($detalles  as $key => $value) {
            $de = DevolucionClienteDetalle::findOrFail($value->id);
            $de->IdDevolucion = $venta->id;

            $de->save();

            $total_cantidad += $de->Cantidad;

            $existe = DetalleVenta::where('IdVenta', $request->IdVenta)
                                                ->where('IdProducto', $value->IdProducto)
                                                ->where('IdPresentacion', $value->IdPresentacion)->exists();
            if($existe){
                $cam = DetalleVenta::where('IdVenta', $request->IdVenta)
                                                ->where('IdProducto', $value->IdProducto)
                                                ->where('IdPresentacion', $value->IdPresentacion)->first();

                $cam->Cantidad = $cam->Cantidad - $value->Cantidad;
                $cam->save();

                if ($cam->Cantidad == 0){
                    $details = DetalleVenta::findOrFail($cam->id);
                    $borrar = $details->delete();

                    $det = Venta::findOrFail($cam->IdVenta);
                    if($det->TotalVenta == 0){
                        $b = $det->delete();
                    }
                    
                }
            }
        }

        $details = DetallesTemporal::all();
        foreach ($details  as $key => $value) {
            DetallesTemporal::destroy($value->id);
        }
        
        return redirect()->route('devolucioncliente.mostrar', ['id'=>$venta->id]);
    }


    public function limpiar($cliente)
    {
        $detalles =  DevolucionClienteDetalle::where('IdDevolucion', 0)->get();
        foreach ($detalles as $key => $value) {

            DB::delete('delete from devolucion_cliente_detalles where id = ?', [$value->id]);
        }

        $details = DetallesTemporal::all();
        foreach ($details  as $key => $value) {
            DetallesTemporal::destroy($value->id);
        }

        return redirect()->route('devolucioncliente.crear', ['clientepedido' => $cliente]);
    }

    public function cerrar()
    {
        $details = DetallesTemporal::all();
        foreach ($details  as $key => $value) {
            DetallesTemporal::destroy($value->id);
        }

        $details2 = DevolucionClienteDetalle::where('IdDevolucion', 0)->get();
        foreach ($details2  as $key => $value) {
            DevolucionClienteDetalle::destroy($value->id);
        }

        return redirect()->route('ventas.index');
    }

    public function show($id)
    {
        $venta = DevolucionCliente::findOrFail($id);
        $vendedor = Personal::findOrFail($venta->vendedor_id);
        $empleado = Personal::findOrFail($venta->devolucion_personal_id);
        $detalles =  DevolucionClienteDetalle::where('IdDevolucion', $venta->id)->get();

        return view('devolucioncliente.verDevolucion', compact('vendedor', 'empleado'))->with('venta', $venta)
            ->with('detalles', $detalles);
    }

    
}