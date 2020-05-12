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

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/', function () {
    return view('home');
});
Route::get('/home', function () {
    return view('home');
});
//login y registro de laravel
Auth::routes();

//tablero
Route::get('/board', function () {
    return view('board');
});
//Rutas para insertar datos en la DB
Route::get('/registrar', 'UserController@devolverFormulario');
Route::post('/registrar', 'UserController@create');
//Route::post('/register', 'UserController@create');
Route::get('/entrar', 'UserController@entrar')->name('login');
//Route::get('/login', 'UserController@entrar');
Route::post('/entrar', 'UserController@iniciado');
//Route::post('/login', 'UserController@iniciado');

//Route::post('/registrar', 'UserController@create');
Route::get('/salir', 'UserController@logOut');

//modificar usuario
Route::get('/modificarUsuario', 'UserController@modificarDatos')->middleware('auth');
Route::post('/modificarUsuario', 'UserController@update');

//lista de partidas de la bd
Route::get('/partidas', 'GameController@verPartidas');
//visualizar una partida
Route::get('/partida/{partida}', 'GameController@partida');
//visualizar los datos de un jugador
Route::get('/jugador/{jugador}', 'PlayerController@jugador');

//filtrarPartidas
Route::get('/buscar_partidas', 'GameController@buscar');

//añadir partida desde la función del programa
Route::get('/registrarPartida', 'GameController@devolverFormularioPartida');
Route::post('/registrarPartida', 'GameController@crearPartida');
//vs IA
Route::get('/practicar', 'GameController@practicar');

//vistas de administrador
//Devolver vista administrador
Route::get('/admin', 'UserController@adminView');//->middleware('admin');
//Admin users
Route::get('/admin/usuarios', 'UserController@adminUser');//->middleware('admin');
Route::post('/admin/usuarios', 'UserController@execAdmin');
//Route::get('/admin/usuarios/add', 'UserController@adminAdd')->middleware('admin');
//Route::get('/admin/usuarios/edit', 'UserController@adminEdit')->middleware('admin');
//Route::get('/admin/usuarios/borrar', 'UserController@destroy')->middleware('admin');
//Admin games
Route::get('/admin/partidas', 'GameController@adminGame');//->middleware('admin');
//Route::get('/admin/partidas/add', 'SerieController@adminAdd')->middleware('admin');
//Route::get('/admin/partidas/edit', 'SerieController@adminEdit')->middleware('admin');
//Route::get('/admin/partidas/borrar', 'SerieController@destroySerie')->middleware('admin');


//crud
//Route::get('/usuario/borrar/{id_usuario}', 'UserController@borrar');
//Route::post('/admin/usuarios', 'UserController@create');

//gestión de errores

Route::any('{catchall}', function(){
    abort(500);
});
Route::get('error', function(){
    abort(500);
});