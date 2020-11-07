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
Route::get('/administrador', function () {
    return view('administrador');
});
Route::get('/carrito', function () {
    return view('carrito');
});
Route::get('/catalogo', function () {
    return view('catalogo');
});
Route::get('/descripcion', function () {
    return view('descripcion');
});
Route::get('/login', function () {
    return view('login');
});
Route::get('/maipogrande', function () {
    return view('maipogrande');
});
Route::get('/registro', function () {
    return view('registro');
});
Route::get('/usuario', function () {
    return view('usuario');
});


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
