<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\Cliente;
use App\Models\Personal;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ServicioController extends Controller
{

    public function index(){
        $texto = '';
        $servicio = Servicio::paginate(10);
        return view('Servicios.raizservicio')->with('servicios', $servicio)->with('texto', $texto);
    }

    public function index2(Request $request){

        $texto =trim($request->get('texto'));

        $servicio = Servicio::where(null)
            ->orwhereRaw('(SELECT NombresDelCliente
                                    FROM clientes WHERE clientes.id = servicios.cliente_id ) LIKE "%'.$texto.'%"')

            ->orwhereRaw('(SELECT ApellidosDelCliente
                                    FROM clientes WHERE clientes.id = servicios.cliente_id ) LIKE "%'.$texto.'%"')
            ->orwhereRaw('(SELECT NombresDelEmpleado
                                    FROM personals WHERE personals.id = servicios.empleado_id ) LIKE "%'.$texto.'%"')

            ->orwhereRaw('(SELECT ApellidosDelEmpleado
                                    FROM personals WHERE personals.id = servicios.empleado_id ) LIKE "%'.$texto.'%"')

            ->paginate(10)->withQueryString();
        return view('Servicios.raizservicio')->with('servicios', $servicio)->with('texto', $texto);
    }

    //funcion para mostrar
    public function show($id){
        $servicio = Servicio::findOrFail($id);
        $id_p = $servicio->empleado_id;
        
        $personal = Personal::findOrFail($id_p);
        $id_c = $personal->cargo_id;

        $cargos = Cargo::findOrFail($id_c);

        return view('Servicios.verServicio')->with('servicio', $servicio)
                                            ->with('cargo', $cargos);
    }

    //funcion para crear o insertar datos
    public function crear(){
        $personals = Personal::select('personals.*', 'cargos.NombreDelCargo')
            ->join('cargos', 'cargos.id', '=', 'personals.cargo_id')
            ->where('NombreDelCargo', 'like', '%tecnico%')
            ->get();

        $clientes = Cliente::all();

        return view('Servicios.formularioServicio', compact('personals', 'clientes'));
    }

    //funcion para guardar los datos creados o insertados
    public function store(Request $request){
        //VALIDAR
        $request->validate([
            'tecnico'=>'required',
            'Cliente'=>'required',
            'Tel??fono'=>'required',
            'FechaDeRealizacion'=>'required|date',
            'Descripci??nDelServicio'=>'required|string|max:200|min:5',
            'Direcci??n'=>'required|max:150'
        ]);

        //Formulario
        $nuevoServicio = new Servicio();
        $nuevoServicio->empleado_id = $request->tecnico;
        $nuevoServicio->cliente_id = $request->Cliente;
        $nuevoServicio->Tel??fonoCliente = $request->input('Tel??fono');
        $nuevoServicio->FechaDeRealizacion = $request->input('FechaDeRealizacion');
        $nuevoServicio->Direcci??n = $request->input('Direcci??n');
        $nuevoServicio->Descripci??nDelServicio = $request->Descripci??nDelServicio;
        $creado = $nuevoServicio->save();

        if($creado){
            return redirect()->route('servicio.index')
                ->with('mensaje', 'El servicio t??cnico fue creado exitosamente');
        }else{
            //retornar con un mensaje de error
        }
    }

    //funcion para editar los datos
    public function edit($id){
        $personals = Personal::select('personals.*', 'cargos.NombreDelCargo')
            ->join('cargos', 'cargos.id', '=', 'personals.cargo_id')
            ->where('NombreDelCargo', 'like', '%tecnico%')
            ->get();
        $clientes = Cliente::all();
        $servicio = Servicio::findOrFail($id);
        return view('Servicios.formularioEditarServicio', compact('personals', 'clientes'))->with('servicio', $servicio);
    }

    //funcion para actualizar los datos
    public function update(Request $request, $id){
        $servicio = Servicio::findOrFail($id);

        $request->validate([
            'tecnico'=>'required',
            'Cliente'=>'required',
            'Tel??fonoCliente'=>[ 'required', 'max:8' . $id ],
            'FechaDeRealizacion'=>'required|date',
            'Descripci??nDelServicio'=>'required|string|max:200|min:5',
            'Direcci??n'=>'required|max:150'
        ]);

        $servicio->empleado_id = $request->tecnico;
        $servicio->cliente_id = $request->Cliente;
        $servicio->Tel??fonoCliente = $request->input('Tel??fonoCliente');
        $servicio->FechaDeRealizacion = $request->input('FechaDeRealizacion');
        $servicio->Direcci??n = $request->input('Direcci??n');
        $servicio->Descripci??nDelServicio = $request->Descripci??nDelServicio;

        $creado = $servicio->update();

        if($creado){
            return redirect()->route('servicio.index')
                ->with('mensaje', 'El servicio t??cnico fue modificado exitosamente');
        }else{
            //retornar con un mensaje de error
        }
    }

    public function updateStatus($id){
        $servicio = Servicio::findOrFail($id);

        if($servicio->Estado == 'Sin realizar'){
            $servicio->Estado = 'Realizado';
        }

        $creado = $servicio->save();

        if($creado){
            return redirect()->route('servicio.index')
                ->with('mensaje', 'El estado fue modificado exitosamente');
        }else{
            //retornar con un mensaje de error
        }

    }
}
