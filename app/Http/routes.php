<?php

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

// 26-02-2021 Nueva ruta para las tipificaciones de forma dinamica
Route::get('cliente/consulta/tipificacion/{id}/','TipificacionController@getTipificaciones');

Route::resource('gestion/tipificacion','TipificacionController');

Route::resource('cliente/consulta','ClienteController');
Route::resource('cliente/general','ClienteController@clientes');
Route::resource('cliente/export','ClienteController@export_clientes');
Route::resource('pago/consulta','PagoController');
Route::resource('cliente/consulta/{id}/','GestionController');
Route::resource('gestion/create/{id}/','GestionController');
Route::resource('gestion/alta/','GestionController@store');

Route::resource('promesa/create/{id}/','PromesaController');
Route::resource('promesa/alta/','PromesaController@store');
Route::resource('cliente/promesa','PromesaController@index');

Route::resource('recordatorio/create/{id}/','RecordatorioController');
Route::resource('recordatorio/alta/','RecordatorioController@store');
Route::resource('cliente/recordatorio','RecordatorioController@index');

Route::resource('seguridad/usuario','UsuarioController');
// Route::resource('seguridad/password','UsuarioController');

Route::resource('seguridad/perfil','PerfilController');

Route::auth();
Route::get('/home', 'UsuarioController@index2');


Route::get('/{slug?}','HomeController@index');
Route::get('/reporte/dashboard','HomeController@index');
Route::get('/carga/saldos', 'saldosController@index');
Route::post('/carga/saldos/import', 'saldosController@import');
// 2020-08-17 nuevas rutas para asignacion de gestores a cuentas
Route::get('/carga/asignacion', 'asignacionController@index');
Route::post('/carga/asignacion/import', 'asignacionController@import');
// 2020-08-20 nuevas rutas para desasignacion de cuentas
Route::get('/carga/desasignacion', 'desasignacionController@index');
Route::post('/carga/desasignacion/import', 'desasignacionController@import');

Route::get('/carga/pagos', 'pagosController@index');
Route::post('/carga/pagos/import', 'pagosController@import');
Route::get('/reporte/consulta', 'GestionDiariaController@index');
Route::get('/gestion/reportegeneral', 'GestionDiariaController@index2');
Route::get('/reporte/cartera', 'GestionDiariaController@index3');
Route::get('/reporte/global', 'GestionDiariaController@index4');
Route::get('/reporte/consulta/export', 'GestionDiariaController@excel');
Route::get('/reporte/general/export', 'GestionDiariaController@excel2');
Route::get('/reporte/saldos/export','GestionDiariaController@excel3');
Route::get('/reporte/cartera/export','GestionDiariaController@excel4');
//Route::resource('/gestion', 'GestionController');
//Route::resource('cliente/gestion', 'GestionController');
