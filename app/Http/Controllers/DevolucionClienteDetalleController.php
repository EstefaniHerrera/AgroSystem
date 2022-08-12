<?php

namespace App\Http\Controllers;

use App\Models\DetallesTemporal;
use App\Models\DetalleVenta;
use App\Models\DevolucionClienteDetalle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        return redirect()->route('devolucioncliente.crear', ['clientepedido' => $clientepedido]);
    }
}
