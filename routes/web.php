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
Route::get('eliminar/partida/{id}', 'GlobalController@eliminarpartida');
Route::post('colorpartida', 'GlobalController@colorpartida');
Route::post('agregarnotaspartida', 'GlobalController@agregarnotaspartida');
	//PartidaMateriales
Route::get('/material/eliminar/{id}','GlobalController@eliminarpresupuestomaterial');
Route::get('/partidamaterial/eliminar/{id}','GlobalController@eliminarpartidamaterial');
Route::get('/partidapresupuesto/{id}','GlobalController@partidapresupuestoactualizar');
Route::post('/agregarotros','GlobalController@agregarotros');
Route::post('/agregarotroscopia','GlobalController@agregarotroscopia');
	//Materiales
Route::get('/materiales', 'GlobalController@materiales');
Route::post('/materiales', 'GlobalController@storemateriales');
Route::post('/agregarmateriales', 'GlobalController@agregarmateriales');
Route::post('/agregarmaterialescopia', 'GlobalController@agregarmaterialescopia');
Route::post('/actualizarmateriales', 'GlobalController@actualizarmateriales');
Route::post('/actualizarmaterialescopia', 'GlobalController@actualizarmaterialescopia');
Route::post('/material/editar/{id}', 'GlobalController@editarmaterial');
Route::get('/eliminar/material/{id}', 'GlobalController@eliminarmaterial');
Route::get('/exportar/materiales/{id}', 'GlobalController@exportarmateriales');
Route::get('/exportar/totalmateriales/{id}', 'GlobalController@exportarmaterialesglobal');
	//Grupos
Route::get('grupos', 'GlobalController@grupos');
Route::get('eliminargrupo/{id}', 'GlobalController@eliminargrupo');
Route::post('storegrupo', 'GlobalController@storegrupo');
Route::get('eliminargrupomaterial/{id}', 'GlobalController@eliminargrupomaterial');
Route::post('agregargrupo', 'GlobalController@agregargrupo');
Route::post('agregargrupocopia', 'GlobalController@agregargrupocopia');
Route::post('modificargrupo', 'GlobalController@modificargrupo');
Route::post('agregarmaterialesgrupo', 'GlobalController@agregarmaterialesgrupo');
Route::post('guardarmaterialesgrupo', 'GlobalController@guardarmaterialesgrupo');
	//Presupuestos
Route::get('/presupuesto/nuevo', 'GlobalController@nuevopresupuesto');
Route::get('/presupuesto/{id}', 'GlobalController@presupuesto');
Route::post('/presupuesto/nuevo', 'GlobalController@storepresupuesto');
Route::post('/presupuesto/agregar', 'GlobalController@agregarpresupuesto');
Route::get('historial', 'GlobalController@historial');
Route::post('actualizarpresupuesto', 'GlobalController@actualizarpresupuesto');
Route::get('exportar/presupuesto/{id}', 'GlobalController@exportarpresupuesto');
Route::get('eliminar/presupuesto/{id}', 'GlobalController@eliminarpresupuesto');
Route::post('colorpresupuesto', 'GlobalController@colorpresupuesto');
Route::post('agregarnotaspresupuesto', 'GlobalController@agregarnotaspresupuesto');
	//Globales
Route::get('configuraciones', 'GlobalController@configuraciones');
Route::post('configuraciones', 'GlobalController@actualizarconfiguraciones');
Route::post('mano', 'GlobalController@storemano');
Route::post('indirecto', 'GlobalController@storeindirecto');
	//Unidades
Route::post('unidades', 'GlobalController@storeunidad');
Route::get('unidad/eliminar/{id}', 'GlobalController@eliminarunidad');
Route::get('mano/eliminar/{id}', 'GlobalController@eliminarmano');
Route::get('indirecto/eliminar/{id}', 'GlobalController@eliminarindirecto');
Route::post('modificarunidad', 'GlobalController@modificarunidad');
	//Partidapresupuesto
Route::get('eliminar/partidapresupuesto/{id}', 'GlobalController@eliminarpartidapresupuesto');
Route::post('agregarnotaspartidapresupuesto', 'GlobalController@agregarnotaspartidapresupuesto');
	//Modificar
Route::post('modificarmano', 'GlobalController@modificarmano');
Route::post('modificarindirecto', 'GlobalController@modificarindirecto');
	//Exportar
Route::get('exportarpartidas','GlobalController@exportarpartidas');
Route::get('exportardata','GlobalController@exportardata');
	//Importar
Route::get('importardata','GlobalController@importardata');
Route::post('importarpartidas','GlobalController@importarpartidas');

