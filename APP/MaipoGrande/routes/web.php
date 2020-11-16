<?php

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
//VISTAS APP
Route::get('/', function () {
    return view('index');
});
Route::get('/contacto', function () {
    return view('contacto');
});
Route::get('/carrito', function () {
    return view('carrito');
});
Route::get('/catalogo', 'App\Http\Controllers\pedidoController@catalogo');

Route::post('/catalogo', [
    'uses' => 'App\Http\Controllers\pedidoController@catalogo',
    'as' => 'catalogo'
]);

Route::get('addCart/{id}', 'App\Http\Controllers\UserController@AddCart');

Route::get('/descripcion', function () {
    return view('descripcion');
});
Route::get('/login', function () {
    return view('login');
});

Route::post('/loguarse', 'App\Http\Controllers\LoginController@loguear') -> name('loguearse');

Route::post('/salir', 'App\Http\Controllers\LoginController@logout') -> name('salir');


Route::get('/maipogrande', function () {
    return view('maipogrande');
});
Route::get('/registro', 'App\Http\Controllers\userController@CargarComuna');

Route::get('/administrador', function () {
    return view('paneladministrador');
});

Route::get('/usuario', function () {
    return view('usuario');
});

Route::get('/CrearUsuario', 'App\Http\Controllers\AdminController@CargarComuna');

Route::get('/ModificarUsuario', 'App\Http\Controllers\AdminController@CargarComunaB');

Route::get('/EliminarUsuario', function () {
    return view('eliminaruser');
});

// Post form data
Route::post('/registro', [
    'uses' => 'App\Http\Controllers\UserController@insertarUser',
    'as' => 'insertarUser'
]); 

Route::post('/EliminarUsuario', [
    'uses' => 'App\Http\Controllers\AdminController@EliminarUser',
    'as' => 'EliminarUser'
]); 

Route::post('/CrearUsuario', [
    'uses' => 'App\Http\Controllers\AdminController@CrearUser',
    'as' => 'CrearUser'
]);

Route::post('/ModificarUsuario', [
    'uses' => 'App\Http\Controllers\AdminController@ModificarUser',
    'as' => 'ModificarUser'
]); 



//VISTAS DE PRUEBA

Route::get('/contacto', function () {
    return view('contacto');
});
Route::get('controlador', 'App\Http\Controllers\UserController@index');

Route::get('test', function () {
    return 'Hola mundo';
});

Route::get('posts/{post_id}/comments/{comment_id}', function ($postId, $commentId) {
    return "Este el comentario {$commentId} del post {$postId}";
});

Route::get('saludo/{name}/{nickname?}', function ($name, $nickname = null) {
    if ($nickname) {
        return "Bienvenido {$name}, tu apodo es {$nickname}";
    } else {
        return "Bienvenido {$name}, no tienes apodo";
    }
});
