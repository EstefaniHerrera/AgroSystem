<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Presentacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CategoriaController extends Controller
{
    public function index(){
        $texto = '';
        $categoria = Categoria::paginate(10);
        return view('Categorias.raizcategorias')->with('categorias', $categoria)->with('texto', $texto);
    }

    public function index2(Request $request){

        $texto =trim($request->get('texto'));

        $categorias = DB::table('Categorias')
                        ->where('NombreDeLaCategoría', 'LIKE', '%'.$texto.'%')
                        ->paginate(10)->withQueryString();
        return view('Categorias.raizcategorias', compact('categorias', 'texto'));
    }

    public function crear(){
        return view('Categorias.formularioCategoria');
    }

    //funcion para guardar los datos creados o insertados
    public function store(Request $request){
        //VALIDAR
        $request->validate([
            'NombreDeLaCategoría'=>'required|unique:categorias|string|max:40|min:5',
            'DescripciónDeLaCategoría'=>'required|string|max:150|min:5'
        ]);

        //Formulario
        $nuevaCategoria = new Categoria();
        $nuevaCategoria->NombreDeLaCategoría = $request->input('NombreDeLaCategoría');
        $nuevaCategoria->DescripciónDeLaCategoría = $request->DescripciónDeLaCategoría;
        $nuevaCategoria->vencimiento = $request->input('vencimiento');
        $nuevaCategoria->elaboracion = $request->input('elaboracion');

        $creado = $nuevaCategoria->save();

        if($creado){

            foreach ($request->input('presentacion') as $presentation) {
                $presentacion = new Presentacion();
                $presentacion->categoria_id = $nuevaCategoria->id;
                $presentacion->informacion = $presentation;

                $creado2 = $presentacion->save();
            }

            return redirect()->route('categoria.index')
                ->with('mensaje', 'La categoría fue creada exitosamente');
        }else{
            //retornar con un mensaje de error
        }
    }
    ///////////////////////////////////////////////////////////////////////////////////
    public function crear2(){
        return view('Compras.formularioCategoria');
    }

    //funcion para guardar los datos creados o insertados
    public function store2(Request $request){
        //VALIDAR
        $request->validate([
            'NombreDeLaCategoría'=>'required|unique:categorias|string|max:40|min:5',
            'DescripciónDeLaCategoría'=>'required|string|max:150|min:5'
        ]);

        //Formulario
        $nuevaCategoria = new Categoria();
        $nuevaCategoria->NombreDeLaCategoría = $request->input('NombreDeLaCategoría');
        $nuevaCategoria->DescripciónDeLaCategoría = $request->DescripciónDeLaCategoría;
        $nuevaCategoria->vencimiento = $request->input('vencimiento');
        $nuevaCategoria->elaboracion = $request->input('elaboracion');

        $creado = $nuevaCategoria->save();

        if($creado){

            foreach ($request->input('presentacion') as $presentation) {
                $presentacion = new Presentacion();
                $presentacion->categoria_id = $nuevaCategoria->id;
                $presentacion->informacion = $presentation;

                $creado2 = $presentacion->save();
            }

            return redirect()->route('compras.crear')
                ->with('mensaje', 'La categoría fue creada exitosamente');
        }else{
            //retornar con un mensaje de error
        }
    }
    ///////////////////////////////////////////////////////////////////////////////////

    //funcion para editar los datos
    public function edit($id){
        $categoria = Categoria::findOrFail($id);
        $presentacion = Presentacion::where('categoria_id',$id)->get();
        return view('categorias.formularioEditarCategoria')->with('categoria', $categoria)->with('presentacion', $presentacion);

    }

     //funcion para actualizar los datos
     public function update(Request $request, $id){

        $categoria = Categoria::findOrFail($id);
        $request->validate([
            'NombreDeLaCategoría'=> [
                'required',
                'string',
                'max:40',
                'min:5',
                Rule::unique('categorias')->ignore($categoria->id),
            ],
            'DescripciónDeLaCategoría'=>'required|string|max:150',
        ]);


        $categoria->NombreDeLaCategoría = $request->input('NombreDeLaCategoría');
        $categoria->DescripciónDeLaCategoría = $request->DescripciónDeLaCategoría;
        
        $categoria->vencimiento = $request->input('vencimiento');
        $categoria->elaboracion = $request->input('elaboracion');

        $creado = $categoria->save();

        if($creado){

            $presentacion = Presentacion::where('categoria_id',$id)->get();
            foreach ($presentacion as $p) {
                $pres = Presentacion::findOrFail($p->id);
                $pres->informacion = $request->input('presentacion'.$p->id);
                $creado = $pres->save();
            }

            if ($request->input('presentacion')!=null) {
                foreach ($request->input('presentacion') as $presentation) {
                    $presentacion = new Presentacion();
                    $presentacion->categoria_id = $categoria->id;
                    $presentacion->informacion = $presentation;
    
                    $creado2 = $presentacion->save();
                }
            }


            return redirect()->route('categoria.index')
                ->with('mensaje', 'La categoría fue modificado exitosamente');
        }else{
            //retornar con un mensaje de error
        }
    }
}