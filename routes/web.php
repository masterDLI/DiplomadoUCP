<?php

use App\Aplicacion;
use App\Perfil;
use App\User;
use Illuminate\Support\Facades\Auth;

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

Route::get('test', function(){

	$perfil = new Perfil;
	$perfil->perfil = 'Admin';
	$perfil->save();

	$user=new User;
	$user->name = 'Roque';
	$user->email = 'grr@mail.com';
	$user->perfil_id = 1;
	$user->password = bcrypt('444444');
	$user->save();
	return $user;

});

Route::get('perfiless', function(){
	return Perfil::with('user')->get();
});

Route::get('perfilapli', function(){

	$perfil_id = auth()->user()->perfil_id;
	$aplicaciones = Perfil::with('aplicaciones')->where('id',$perfil_id)->first()->aplicaciones;
	foreach ($aplicaciones as $aplicacion) {
		echo $aplicacion->url.'<br>';
	}

});

Route::get('apliperfil', function(){
	return Aplicacion::with('perfil')->get();
});

Route::get('userperfil', function(){

	// $user = auth()->user();
	return auth()->user()->aplicaciones();
});

Auth::routes();
Route::get('/', 'Auth\LoginController@showLoginForm');
Route::post('/', 'Auth\LoginController@login');
Route::get('/home', 'HomeController@index')->name('home');

Route::resource('encuestas','EncuestasController');
Route::resource('preguntas','PreguntasController');
Route::resource('resultados','ResultadosController');
Route::resource('formatos_respuestas','Formatos_respuestasController');
Route::resource('valores','ValoresController');
Route::resource('perfiles','PerfilesController');
Route::resource('usuarios','UsersController');
Route::get('resetpass/{id}',['as'=>'resetpass', 'uses'=>'UsuariosResetPassController@blanquear']);
Route::resource('aplicaciones', 'AplicacionesController');
Route::resource('cuestionarios', 'CuestionariosController');

Route::get('listado_cuestionarios',['as'=>'listado', 'uses'=>'CuestionariosController@listado']);
Route::get('estadistica_cuestionarios',['as'=>'estadistica', 'uses'=>'CuestionariosController@estadistica']);

Route::resource('notificaciones','NotificacionesController');