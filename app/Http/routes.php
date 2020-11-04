<?php

use Illuminate\Support\Facades\Route;
use Ctapp\Http\Controllers;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Route::resource('usuario/rol', 'RolController');
Route::resource('usuario/user','UserController');
Route::resource('/registro','RegistroController');
Route::resource('usuario/usert','UsuarioAuxController');
Route::resource('/ccliente', 'ClienteController');
Route::resource('estado/cliente', 'EstadoClienteController');
Route::resource('estado/procedimiento', 'EstadoProcedimientoController');
Route::resource('pprocedimiento','ProcedimientoController');
Route::resource('puntuacion','PuntuacionController');

Route::auth();

Route::get('/home', 'HomeController@index');
Route::get('/{slug?}', 'HomeController@index');