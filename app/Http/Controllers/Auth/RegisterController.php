<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
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
            'username.max' => '¡Has excedido el limite máximo de 70 letras!',
            'username.unique' => '¡Debes ingresar un nombre de usuario diferente!',

            'password.required' => 'Debes ingresar una contraseña',
            'password.string' => 'Debes ingresar una contraseña y confirmarla',
            'password.min' => 'Debes ingresar una contraseña segura',
            'password.confirmed' => 'Debes confirmar tu contraseña',

            'personal.required' => 'El empleado, debe ser seleccionado',
            'personal.string' => 'Debes seleccionar un empleado',
            'personal.unique' => 'El empleado seleccionado ya ha sido registrado como usuario',

            'pregunta_a.required' => 'Debe ingresar el nombre de la mascota',
            'pregunta_a.string' => 'El nombre de la mascota solo debe contener letras',
            'pregunta_a.min' => 'Debe ingresar un nombre de 3 o más letras',
            'pregunta_a.mac' => 'Debe ingresar un nombre de mascota que no exceda de 40 letras',

            'pregunta_b.required' => 'Debe seleccionar su color favorito',

            'pregunta_c.required' => 'Debe seleccionar la religión a la que pertenece',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'username' => $data['email'],
            'password' => Hash::make($data['password']),
            'pregunta_a' => Hash::make ($data['pregunta_a']),
            'pregunta_b' => Hash::make ($data['pregunta_b']),
            'pregunta_c' => Hash::make ($data['pregunta_c']),
            'id_personal' => $data['id_personal'],
        ]);
    }
}
