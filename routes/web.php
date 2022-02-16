<?php

use App\Http\Controllers\PersonalController;
use App\Http\Controllers\CargoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/********************************* PERSONAL *********************************/

//ruta para leer
Route::get('/personals', [PersonalController::class, 'index'])
->name('personal.index');

//ruta para barra de busqueda
Route::get('/personals/buscar', [PersonalController::class, 'index2'])
->name('personal.index2');

//ruta para mostrar
Route::get('/personals/{id}', [PersonalController::class, 'show'])
->name('personal.mostrar')->where('id', '[0-9]+');

//ruta para crear
Route::get('/personals/crear', [PersonalController::class, 'crear'])
->name('personal.crear');

//ruta para postear
Route::post('/personals/crear', [PersonalController::class, 'store'])
->name('personal.guardar');

//ruta para mostrar formulario
Route::get('/personals/{id}/editar', [PersonalController::class, 'edit'])
->name('personal.edit')->where('id', '[0-9]+');

//para actualizar los datos
Route::put('/personals/{id}/editar', [PersonalController::class, 'update'])
->name('personal.update')->where('id', '[0-9]+');

//ruta para cambiar estado
Route::get('/estado/{id}', [PersonalController::class, 'updateStatus'])
 ->name('status.update')->where('id', '[0-9]+');

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

Route::get('/cargos', [CargoController::class, 'index'])
->name('cargo.index');

//ruta para crear
Route::get('/cargos/crear', [CargoController::class, 'crear'])
->name('cargo.crear');

//ruta para postear
Route::post('/cargos/crear', [CargoController::class, 'store'])
->name('cargo.guardar');

//ruta para mostrar formulario
Route::get('/cargos/{id}/editar', [CargoController::class, 'edit'])
->name('cargo.edit')->where('id', '[0-9]+');

//para actualizar los datos
Route::put('/cargos/{id}/editar', [CargoController::class, 'update'])
->name('cargo.update')->where('id', '[0-9]+');