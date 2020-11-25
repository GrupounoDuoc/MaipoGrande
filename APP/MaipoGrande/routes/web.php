<?php

use Illuminate\Support\Facades\Route;



//Routes Admin
Route::get('/admin', 'App\Http\Controllers\adminController\adminviewController@ViewPanelAdmin')->name('admin');

//Route::get('/cliente', 'App\Http\Controllers\clientesController\clienteviewController@ViewPanelCliente')->name('cliente');

Route::get('/usuario', 'App\Http\Controllers\usuariosController\usuarioviewController@ViewPanelUsuario')->name('usuario');

Route::post('/crearUsuario', 'App\Http\Controllers\usuariosController\usuarioviewController@CrearUser')->name('CrearUsuario');

Route::get('/producto', 'App\Http\Controllers\productosController\productoviewController@ViewPanelProducto')->name('producto');


//VISTAS APP
Route::get('/', function () {
    return view('index');
});



Route::get('/contacto', function () {
    return view('contacto');
});
Route::get('/administrador', function () {
    return view('principal');
});

Route::get('deleteCart/{id}', 'App\Http\Controllers\pedidoController@deleteCart');

Route::get('/carrito', 'App\Http\Controllers\pedidoController@carrito');

Route::get('/comprar', 'App\Http\Controllers\pedidoController@comprar');

Route::get('/compraExitosa', 'App\Http\Controllers\pedidoController@compraExitosa');
Route::get('/catalogo', 'App\Http\Controllers\pedidoController@catalogo');

Route::post('/catalogo', [
    'uses' => 'App\Http\Controllers\pedidoController@catalogo',
    'as' => 'catalogo'
]);

Route::get('/descripcion', function () {
    return view('descripcion');
});

route::get('login', function () {
    return view('login');
});

route::post('login', 'App\Http\Controllers\LoginController@login')->name('login');

Route::get('logout', 'App\Http\Controllers\LoginController@logout')->name('logout');

Route::get('/maipogrande', function () {
    return view('maipogrande');
});
Route::get('/registro', 'App\Http\Controllers\userController@CargarComuna');

Route::get('/administrador', function () {
    return view('paneladministrador');
});

//Route::get('/usuario', function () {
  //  return view('usuario');
//});

Route::get('/IngresarProducto', function () {
    return view('IngresarProducto');
});

//panel de admin - para comunas
//Route::get('/cliente', 'App\Http\Controllers\AdminController@CargarComuna');

Route::get('/ModificarUsuario', 'App\Http\Controllers\AdminController@CargarComunaB');

Route::get('/ModificarProducto', function () {
    return view('ModificarProducto');
});

Route::get('/EliminarUsuario', function () {
    return view('eliminaruser');
});

Route::get('deleteProducto/{id}', 'App\Http\Controllers\AdminController@destroyProducto');

Route::get('deleteUser/{rut}', 'App\Http\Controllers\AdminController@destroyUser');

Route::get('/ListarUsuario', 'App\Http\Controllers\adminController@ListarUser');

Route::get('/ListarProducto', 'App\Http\Controllers\adminController@Listarproducto');


// Post form data
Route::post('/registro', [
    'uses' => 'App\Http\Controllers\UserController@insertarUser',
    'as' => 'insertarUser'
]);

Route::post('/EliminarUsuario', [
    'uses' => 'App\Http\Controllers\AdminController@EliminarUser',
    'as' => 'EliminarUser'
]);

Route::post('/cliente', [
    'uses' => 'App\Http\Controllers\AdminController@CrearUser',
    'as' => 'CrearUser'
]);

Route::post('/IngresarProducto', [
    'uses' => 'App\Http\Controllers\AdminController@IngresarProducto',
    'as' => 'IngresarProducto'
]);

Route::post('/ModificarUsuario', [
    'uses' => 'App\Http\Controllers\AdminController@ModificarUser',
    'as' => 'ModificarUser'
]);

Route::post('/ListarUsuario', [
    'uses' => 'App\Http\Controllers\AdminController@ListarUser',
    'as' => 'ListarUser'
]);

Route::post('/ListarProducto', [
    'uses' => 'App\Http\Controllers\AdminController@ListarProducto',
    'as' => 'ListarProducto'
]);

Route::post('/ModificarProducto', [
    'uses' => 'App\Http\Controllers\AdminController@ModificarProducto',
    'as' => 'ModificarProducto'
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
