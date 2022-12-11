<?php

namespace App\Http\Controllers;

use App\Models\Personal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $texto = '';
        $users = User::paginate(10);
        return view('usuarios.raizUsuario')->with('users', $users)->with('texto', $texto);
    }

    public function index2(Request $request){
        $texto =trim($request->get('texto'));

        $users = DB::table('users')
            ->select('*')
            ->where('name', 'LIKE', '%'.$texto.'%')
            ->orwhere('username', 'LIKE', '%'.$texto.'%')
            ->paginate(10)->withQueryString();
        return view('usuarios.raizUsuario', compact('users', 'texto'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $personals = Personal::where('EmpleadoActivo', 'Activo')->get();
        return view('usuarios.formularioUsuario', compact('personals'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:20', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'personal' => ['required', 'string', 'exists:personals,id','unique:users,id_personal'],
            'pregunta_a' => ['required', 'string','min:3', 'max:250'],
            'pregunta_b' => ['required'],
            'pregunta_c' => ['required'],
        ], [
            'username.required' => '¡Debes ingresar tu nombre de usuario!',
            'username.string' => '¡Debes ingresar tu nombre de usuario, verifica la información!',
            'username.max' => '¡Has excedido el limite máximo de 20 letras en el nombre de usuario!',
            'username.unique' => '¡Debes ingresar un nombre de usuario diferente!',

            'password.required' => 'Debes ingresar una contraseña',
            'password.string' => 'Debes ingresar una contraseña y confirmarla',
            'password.min' => 'Debes ingresar una contraseña segura, con mas de 8 dígitos',
            'password.confirmed' => 'Debes confirmar tu contraseña',

            'personal.required' => 'El empleado, debe ser seleccionado',
            'personal.string' => 'Debes seleccionar un empleado',
            'personal.unique' => 'El empleado seleccionado ya ha sido registrado como usuario',

            'pregunta_a.required' => 'Debe ingresar el nombre de la mascota',
            'pregunta_a.string' => 'El nombre de la mascota solo debe contener letras',
            'pregunta_a.min' => 'Debe ingresar un nombre de 3 o más letras',
            'pregunta_a.mac' => 'Debe ingresar un nombre de mascota que no exceda de 40 letras',

            'pregunta_b.required' => 'Debe ingresar su color favorito',

            'pregunta_c.required' => 'Debe ingresar la religión a la que pertenece',
        ]);

        $personal = Personal::findOrFail($request->input('personal'));

        User::create([
            'name' =>  $personal->NombresDelEmpleado." ".$personal->ApellidosDelEmpleado,
            'username' => $request->input('username'),
            'id_personal' => $request->input('personal'),
            'pregunta_a' => bcrypt($request['pregunta_a']),
            'pregunta_b' => bcrypt($request['pregunta_b']),
            'pregunta_c' => bcrypt($request['pregunta_c']),
            'password' => bcrypt($request['password']),
        ]);

        return redirect()->route('usuarios.index')->with('mensaje', 'El usuario fue agregado exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function cambiar_contrasena(){
        $users = User::all();
        return view('usuarios.formularioCambiarContrasena', compact('users'));
    }

    public function eliminar($id){
    
        User::destroy($id);
        return redirect()->route('usuarios.index');

    } 
}
