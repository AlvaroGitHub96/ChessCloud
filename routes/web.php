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
Route::get('/entrar', 'UserController@entrar');
Route::post('/entrar', 'UserController@iniciado');
//Route::post('/registrar', 'UserController@create');
Route::get('/salir', 'UserController@logOut');

//modificar usuario
Route::get('/modificarUsuario', 'UserController@modificarDatos')->middleware('auth');
Route::post('/modificarUsuario', 'UserController@update');