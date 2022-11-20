<?php

namespace App\Http\Controllers;

use App\Models\Catalogo;
use App\Models\Proveedor;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CatalogoController extends Controller{

    public function index(){
        $id = 0;
        $fechadesde = 0;
        $fechahasta = 0;
        $proveedor = Proveedor::all();
        $catalogo = Catalogo::paginate(10);
        return view('Catalogo.raizCatalogo', compact('proveedor','catalogo', 'id', 'fechadesde', 'fechahasta'));
    }

    public function buscar(Request $request)
    {
        $proveedor = Proveedor::all();
        $id = $request->get('id');
        $fechadesde = $request->get('FechaDesde');
        $fechahasta = $request->get('FechaHasta');


        if ($id == 0) {
            if ($fechadesde == '' && $fechahasta == '') {
                $request->validate([
                    
                ]);
                $rules = [
                    'id' => 'required|numeric|min:1',
                    'FechaDesde' => 'required',
                    'FechaHasta' => 'required',
                ];
        
                $mensaje = [
                    'id.min' => 'Seleccione un proveedor o',
                    'FechaDesde.required' => 'ingrese una fecha de inicio y',
                    'FechaHasta.required' => 'una fecha de fin',
                ];
                $this->validate($request, $rules, $mensaje);

                $fechadesde = 0;
                $fechahasta = 0;
            } else {
                $request->validate([
                    'FechaDesde' => '',
                    'FechaHasta' => 'after_or_equal:FechaDesde',
                ]);
    
                $catalogo = DB::table('catalogo')
                    ->select('catalogo.*')
                    ->join('proveedors', 'proveedors.id', '=', 'catalogo.proveedor_id')
                    ->whereBetween('FechaDeCatalogo', [$fechadesde, $fechahasta])
                    ->paginate(15)->withQueryString();
            }
            } else {
                if ($fechadesde == '') {
                    $catalogo = DB::table('catalogo')
                        ->select('catalogo.*')
                        ->join('proveedors', 'proveedors.id', '=', 'catalogo.proveedor_id')
                        ->where('catalogo.proveedor_id', '=', $id)
                        ->paginate(15)->withQueryString();

                    $fechadesde = 0;
                    $fechahasta = 0;
                } else {
                    $catalogo = DB::table('catalogo')
                        ->select('catalogo.*')
                        ->join('proveedors', 'proveedors.id', '=', 'catalogo.proveedor_id')
                        ->whereBetween('FechaDeCatalogo', [$fechadesde, $fechahasta])
                        ->where('catalogo.proveedor_id', '=', $id)
                        ->paginate(15)->withQueryString();
                }
            }

        foreach ($catalogo as $key => $value) {
            $value->proveedors = Proveedor::findOrFail($value->proveedor_id);
        }

        return view('Catalogo.raizCatalogo', compact('proveedor', 'catalogo', 'id', 'fechadesde', 'fechahasta'));
    }


    public function crear(){
        $proveedor = Proveedor:: all();
        return view('catalogo.formularioCatalogo')->with('proveedor', $proveedor);

    }

    public function store(Request $request){

        $request->validate([
            'NombreCatálogo'=>'required|string|max:150|min:5',
        ], [
            'NombreCatálogo.required'=>'Agregue un nombre y una descripción para el catálogo'
        ]);
    

        try {
            DB::beginTransaction(); 
            $reg=new Catalogo();
            $reg->proveedor_id = $request->get('Proveedor');
            $reg->NombreCatálogo = $request->get('NombreCatálogo');
            $reg->FechaDeCatalogo = $request->get('FechaDeCatalogo');
            if ($request->hasFile('pdf')){
                $archivo=$request->file('pdf');
                $archivo->move(public_path().'/Archivos/',$archivo->getClientOriginalName());
                $reg->Documento=$archivo->getClientOriginalName();
            }
            $reg->save();
            DB::commit(); // ENVIAR
        } catch (\Exception $e){
            DB::rollBack();
        }

        if ($reg){
        return redirect() ->route('catalogo.index') ->with('mensaje', 'El catálogo fue guardado exitosamente');
        } else {
        }  

    }

    public function edit($id){
        $proveedor = Proveedor::all();
        $catalogo = Catalogo::findOrFail($id);
        return view('Catalogo.formularioEditarCatalogo', compact('catalogo'))->with('proveedor', $proveedor);
    }

    public function update(Request $request, $id){

        
        $request->validate([
            'NombreCatálogo'=>'required|string|max:150|min:5',
        ], [
            'NombreCatálogo.required'=>'Agregue un nombre y una descripción para el catálogo'
        ]);

        try {
            DB::beginTransaction(); 
            $reg= Catalogo::findOrFail($id);
            $reg->proveedor_id = $request->get('Proveedor');
            $reg->NombreCatálogo = $request->get('NombreCatálogo');
            $reg->FechaDeCatalogo = $request->get('FechaDeCatalogo');
                if ($request->hasFile('pdf')){
                    $archivo=$request->file('pdf');
                    $archivo->move(public_path().'/Archivos/',$archivo->getClientOriginalName());
                    $reg->Documento=$archivo->getClientOriginalName();
                }
                $reg->save();
                DB::commit(); // ENVIAR
            } catch (\Exception $e){
                DB::rollBack();
            }
    

        if ($reg){
            return redirect() ->route('catalogo.index') ->with('mensaje', 'El catálogo fue modificado exitosamente');
        } 
        else {
        }  

    }

    public function eliminar($id){
    
        Catalogo::destroy($id);
        return redirect()->route('catalogo.index');

    } 
        
}
