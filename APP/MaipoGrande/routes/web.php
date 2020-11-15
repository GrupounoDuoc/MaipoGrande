<?php

use Illuminate\Support\Facades\Route;



//Routes Admin
Route::get('/admin', 'App\Http\Controllers\adminController\adminviewController@ViewPanelAdmin')->name('admin');

Route::get('/cliente', 'App\Http\Controllers\clientesController\clienteviewController@ViewPanelCliente')->name('cliente');


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
Route::get('/catalogo', 'App\Http\Controllers\pedidoController@catalogo');
Route::get('/descripcion', function () {
    return view('descripcion');
});
Route::get('/login', function () {
    return view('login');
});
Route::get('/maipogrande', function () {
    return view('maipogrande');
});
Route::get('/registro', 'App\Http\Controllers\userController@CargarComuna');

Route::get('/administrador', 'App\Http\Controllers\AdminController@CargarComuna');

Route::get('/usuario', function () {
    return view('usuario');
});




// Post form data
Route::post('/registro', [
    'uses' => 'App\Http\Controllers\UserController@insertarUser',
    'as' => 'insertarUser'
]);

Route::post('/administrador', [
    'uses' => 'App\Http\Controllers\AdminController@CrearUser',
    'as' => 'CrearUser'
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
