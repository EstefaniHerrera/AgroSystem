<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\CambiarContrasenaRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function update_contrasena(Request $request){
        $this->validate($request, [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'pregunta_a' => ['required', 'string','min:3', 'max:250'],
            'pregunta_b' => ['required'],
            'pregunta_c' => ['required'],
        ], [
            'password.required' => 'Debes ingresar una contraseña',
            'password.string' => 'Debes ingresar una contraseña y confirmarla',
            'password.min' => 'Debes ingresar una contraseña segura, con mas de 8 dígitos',
            'password.confirmed' => 'La contraseña de confirmación no coincide',

            'pregunta_a.required' => 'Debe ingresar el nombre de la mascota',
            'pregunta_a.string' => 'El nombre de la mascota solo debe contener letras',
            'pregunta_a.min' => 'Debe ingresar un nombre de 3 o más letras',
            'pregunta_a.mac' => 'Debe ingresar un nombre de mascota que no exceda de 40 letras',

            'pregunta_b.required' => 'Debe ingresar su color favorito',

            'pregunta_c.required' => 'Debe ingresar la religión a la que pertenece',
        ]);

        $user = User::findOrFail($request->Empleado);
        $preguntaa = $user->pregunta_a;
        $preguntab = $user->pregunta_b;
        $preguntac = $user->pregunta_c;

        if((password_verify($request['pregunta_a'], $preguntaa)) && (password_verify($request['pregunta_b'], $preguntab)) && (password_verify($request['pregunta_c'], $preguntac))){
            $user->update([
                'password' => bcrypt($request['password']),
            ]);
    
            return redirect()->route('login')
                ->with('error', 'La contraseña fue modificada exitosamente.');
        }
        else{
            return redirect()->route('usuarios.cambiar_contrasena')
                    ->with('error', 'Datos incorrectos');
        }
    
        
    }

    public function update_contrasena2(Request $request, User $user){
        $this->validate($request, [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'contrasenaAnterior' => ['required', 'string', 'min:8'],
        ], [
            'password.required' => 'Debes ingresar una contraseña',
            'password.string' => 'Debes ingresar una contraseña y confirmarla',
            'password.min' => 'Debes ingresar una contraseña segura, con mas de 8 dígitos',
            'password.confirmed' => 'La contraseña de confirmación no coincide',

            'contrasenaAnterior.required' => 'Debe ingresar su contraseña actual.'
        ]);
        $contrasenaAnterior = $user->password;

        if(password_verify($request['contrasenaAnterior'], $contrasenaAnterior)){
            $user->update([
                'password' => bcrypt($request['password']),
            ]);
    
            return back()
                ->with('mensaje', 'La contraseña fue modificada exitosamente.');
        }
        else{
            return back()
                    ->with('errorcontra', 'La contraseña actual ingresada es incorrecta.');
        }
    
        
    }
}
