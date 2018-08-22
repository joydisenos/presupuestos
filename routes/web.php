<?php

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
	if(Auth::guest())
	{
	    return view('auth.login');
	}
	else
	{
	    return redirect('home');
	}
});

Auth::routes();

// Auth
// 
Route::get('/home', 'GlobalController@index')->name('home');
	//Partidas
Route::get('/partidas', 'GlobalController@partidas');
Route::post('/partidas', 'GlobalController@storepartidas');
Route::get('/partida/{id}', 'GlobalController@partida');
	//Materiales
Route::get('/materiales', 'GlobalController@materiales');
Route::post('/materiales', 'GlobalController@storemateriales');
Route::post('/agregarmateriales', 'GlobalController@agregarmateriales');
Route::post('/actualizarmateriales', 'GlobalController@actualizarmateriales');
	//Presupuestos
Route::get('/presupuesto/nuevo', 'GlobalController@nuevopresupuesto');
Route::get('/presupuesto/{id}', 'GlobalController@presupuesto');
Route::post('/presupuesto/nuevo', 'GlobalController@storepresupuesto');
Route::post('/presupuesto/agregar', 'GlobalController@agregarpresupuesto');
Route::get('historial', 'GlobalController@historial');
Route::post('actualizarpresupuesto', 'GlobalController@actualizarpresupuesto');
Route::get('exportar/presupuesto/{id}', 'GlobalController@exportarpresupuesto');
	//Globales
Route::get('configuraciones', 'GlobalController@configuraciones');
Route::post('configuraciones', 'GlobalController@actualizarconfiguraciones');
Route::post('mano', 'GlobalController@storemano');
Route::post('indirecto', 'GlobalController@storeindirecto');



