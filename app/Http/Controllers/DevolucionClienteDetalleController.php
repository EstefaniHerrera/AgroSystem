<?php

namespace App\Http\Controllers;

use App\Models\DetallesTemporal;
use App\Models\DetalleVenta;
use App\Models\DevolucionClienteDetalle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use PhpParser\Node\Stmt\Return_;
use Symfony\Contracts\Service\Attribute\Required;

class DevolucionClienteDetalleController extends Controller
{
    //
    public function agregar_detalle(Request $request, $clientepedido){

        $limite = DB::table('detalles_temporals')->where('id', '=', $request->input('IdDetalle'))->first();
        $max = $limite->Cantidad;

        $request->validate([
            'Cantidad' => 'required|numeric|min:1|max:' . ($max),
        ], [
            'Cantidad.max' => 'Solo puede devolver ' . ($max) . ' unidades de este producto',
        ]);

        $detalleventa = DetallesTemporal::findOrFail($request->IdDetalle);
        $detalledevolucion = new DevolucionClienteDetalle();
        $detalledevolucion->IdDevolucion = 0;
        $detalledevolucion->IdProducto = $detalleventa->IdProducto;
        $detalledevolucion->IdPresentacion = $detalleventa->IdPresentacion;
        $detalledevolucion->Cantidad = $request->Cantidad;
        $detalledevolucion->Precio_venta = $detalleventa->Precio_venta;
        $detalledevolucion->save();

        $detalles = DetallesTemporal::findOrFail($request->input('IdDetalle'));
        $detalles->IdVenta = null;
        $detalles->save();

        /* #77 Corrección para que no se borre la descripción */
        $InvoiceInformation = [
            'descripcion' =>  $request->input('descripcion'),/* 
            'Proveedor' =>  $request->input('Proveedor'),
            'FechaCompra' =>  $request->input('FechaCompra'),
            'FechaPago' =>  $request->input('FechaPago'),
            'PagoCompra' =>  $request->input('PagoCompra'), */
        ];
        return redirect()->back()->with('console',json_encode($InvoiceInformation));
    }
}
