<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use Illuminate\Http\Request;

class CargoController extends Controller
{
    public function index(){
        $cargo = Cargo::paginate(10);
        return view('cargos.raizcargos')->with('cargos', $cargo);
    }

    //funcion para la barra
    /* public function index2(Request $request){
        
        $texto =trim($request->get('texto'));
        $personals = DB::table('Personals')
                        ->where('NombrePersonal', 'LIKE', '%'.$texto.'%')
                        ->orWhere('cargo_id', 'LIKE', '%'.$texto.'%')
                        ->paginate(10);
        return view('buscarPersonal', compact('personals', 'texto'));
    } */

    //funcion para crear o insertar datos
    public function crear(){
        return view('cargos.formularioCargo');
    }

    //funcion para guardar los datos creados o insertados
    public function store(Request $request){
        //VALIDAR
        $request->validate([
            'NombreDelCargo'=>'required|unique:cargos|string|max:40|min:5',
            'DescripciónDelCargo'=>'required|string|max:150|min:5',
            'Sueldo'=>'required|numeric|min:1000.00|max:30000.00'
        ]);

        //Formulario
        $nuevoCargo = new Cargo();
        $nuevoCargo->NombreDelCargo = $request->input('NombreDelCargo');
        $nuevoCargo->DescripciónDelCargo = $request->DescripciónDelCargo;
        $nuevoCargo->Sueldo = $request->input('Sueldo');

        $creado = $nuevoCargo->save();

        if($creado){
            return redirect()->route('cargo.index')
                ->with('mensaje', 'El cargo fue creado exitosamente');
        }else{
            //retornar con un mensaje de error
        }
    }

    //funcion para editar los datos
    public function edit($id){
        $cargo = Cargo::findOrFail($id);
        return view('cargos.formularioEditarCargo')->with('cargo', $cargo);

    }

    //funcion para actualizar los datos
    public function update(Request $request, $id){

        $request->validate([
            'NombreCargo'=>'required',
            'DescripcionCargo'=>'required',
            'Sueldo'=>'required'
        ]);

        $cargo = Cargo::findOrFail($id);
        $cargo->NombreCargo = $request->input('NombreCargo');
        $cargo->DescripcionCargo = $request->DescripcionCargo;
        $cargo->Sueldo = $request->input('Sueldo');

        $creado = $cargo->save();

        if($creado){
            return redirect()->route('cargo.index')
                ->with('mensaje', 'El cargo fue modificado exitosamente');
        }else{
            //retornar con un mensaje de error
        }
    }
}
