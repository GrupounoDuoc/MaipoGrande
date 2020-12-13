<?php

use App\Http\Controllers\PDFController;
use Illuminate\Support\Facades\Route;
use Barryvdh\DomPDF\Facade as PDF;
use App\Models\persona;
use App\Models\tipo_fruta;

//Routes Admin
Route::get('/admin', 'App\Http\Controllers\adminController\adminviewController@ViewPanelAdmin')->name('admin');

//Route::get('/cliente', 'App\Http\Controllers\clientesController\clienteviewController@ViewPanelCliente')->name('cliente');

Route::get('/usuario', 'App\Http\Controllers\usuariosController\usuarioviewController@ViewPanelUsuario')->name('usuario');

Route::get('/Transportistas', 'App\Http\Controllers\usuariosController\usuarioviewController@ViewPanelDetalleTransportista')->name('Transportistas');

Route::post('/crearUsuario', 'App\Http\Controllers\usuariosController\usuarioviewController@CrearUser')->name('CrearUsuario');

Route::post('/eliminarUsuario', 'App\Http\Controllers\usuariosController\usuarioviewController@EliminarUser')->name('EliminarUsuario');

Route::get('deleteUser/{rut}', 'App\Http\Controllers\usuariosController\usuarioviewController@destroyUser');

Route::get('destroyDetalleTransportista/{id_detalle_transportista}', 'App\Http\Controllers\usuariosController\usuarioviewController@destroyDetalleTransportista');

Route::post('/modificarUsuario', 'App\Http\Controllers\usuariosController\usuarioviewController@ModificarUser')->name('ModificarUsuario');// ruta es = Modificar Usuario

Route::post('/getUserByRut', 'App\Http\Controllers\usuariosController\usuarioviewController@getUserByRut')->name('getUserByRut');// Se llama a la ruta desde el ajax 




Route::get('/producto', 'App\Http\Controllers\productosController\productoviewController@ViewPanelProducto')->name('producto');
Route::get('deleteUser/{rut}', 'App\Http\Controllers\productosController\productoviewController@destroyProducto');
Route::post('/crearProducto', 'App\Http\Controllers\productosController\productoviewController@CrearProduct')->name('CrearProducto');
Route::get('/editProduct', 'App\Http\Controllers\productosController\productoviewController@editProduct')->name('editProduct');
Route::put('/updateProduct', 'App\Http\Controllers\productosController\productoviewController@updateProduct')->name('updateProduct');


//pdf
//Route::get('/pdf', 'PDFController@PDF')->name('descargarPDF');




Route::post('/IngresarProducto', [
     'uses' => 'App\Http\Controllers\AdminController@IngresarProducto',
     'as' => 'IngresarProducto'
 ]);


//VISTAS APP
Route::get('/', function () {
    return view('index');
})->name('/');
Route::get('/contacto', function () {
    return view('contacto');
});
Route::get('/administrador', function () {
    return view('administrador');
});

Route::get('/carrito', 'App\Http\Controllers\pedidoController@carrito');

Route::get('/comprar', 'App\Http\Controllers\pedidoController@comprar');

Route::get('/compraErronea', 'App\Http\Controllers\pedidoController@compraErronea');

Route::get('/compraExitosa', 'App\Http\Controllers\pedidoController@compraExitosa');

Route::get('/catalogo', 'App\Http\Controllers\pedidoController@catalogo');

Route::post('/catalogo', [
    'uses' => 'App\Http\Controllers\pedidoController@catalogo',
    'as' => 'catalogo'
]);

Route::get('/pedidos', 'App\Http\Controllers\pedidoController@pedidos');

Route::post('/pedidos', [
    'uses' => 'App\Http\Controllers\pedidoController@pedidos',
    'as' => 'pedidos'
]);
Route::get('addCart/{id}', 'App\Http\Controllers\UserController@AddCart');

Route::get('deleteCart/{id}', 'App\Http\Controllers\pedidoController@deleteCart');

Route::get('/descripcion', function () {
    return view('descripcion');
});

Route::get('/seguimiento', 'App\Http\Controllers\SeguimientoController@seguimiento')-> name('seguimiento');

route::get('login', function () {
    return view('login');
});

route::post('login', 'App\Http\Controllers\LoginController@login')->name('login');

Route::get('logout', 'App\Http\Controllers\LoginController@logout')->name('logout');

Route::get('/maipogrande', function () {
    return view('maipogrande');
});
Route::get('/registro', 'App\Http\Controllers\userController@CargarComuna');


Route::get('/PublicarPedidoExt', 'App\Http\Controllers\pedidoController@pedidoExterno')->name('PublicarPedidoExt');

Route::post('/PublicarPedidoExt', 'App\Http\Controllers\pedidoController@pedidoExterno');

Route::get('/PublicarPedido', 'App\Http\Controllers\pedidoController@CargarDatos');

Route::get('/administrador', function () {
    return view('paneladministrador');
});

// Route::get('/usuario', function () {
//     return view('usuario');
// });

Route::get('/IngresarProducto', function () {
    return view('IngresarProducto');
});

Route::get('/CrearUsuario', 'App\Http\Controllers\AdminController@CargarComuna');

Route::get('/Reportes', 'App\Http\Controllers\ReportesController@CargarReporte');

Route::get('/ModificarUsuario', 'App\Http\Controllers\AdminController@CargarComunaB');


Route::get('/ModificarContratos', 'App\Http\Controllers\AdminController@CargarUsuarios');

Route::get('/ModificarProducto', function () {
    return view('ModificarProducto');
});

Route::get('/EliminarUsuario', function () {
    return view('eliminaruser');
});

Route::get('deleteProducto/{id}', 'App\Http\Controllers\AdminController@destroyProducto');

Route::get('deleteUser/{rut}', 'App\Http\Controllers\AdminController@destroyUser');

Route::get('/ListarUsuario', 'App\Http\Controllers\adminController@Listaruser');

Route::get('/ListarProducto', 'App\Http\Controllers\adminController@Listarproducto');

Route::get('/VentasExternas', 'App\Http\Controllers\pedidoController@CargarVentasExternas')->name('VentasExternas');


//Ruta para imprimir PDF de reporte
Route::name('imprimir')->get('/Reporte', 'App\Http\Controllers\ReportesController@imprimir');


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

Route::post('/Transportistas', [
    'uses' => 'App\Http\Controllers\usuariosController\usuarioviewController@CrearDetalleTransportista',
    'as' => 'CrearDetalleTransportista'
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

Route::post('/PublicarVenta', [
    'uses' => 'App\Http\Controllers\pedidoController@PublicarVenta',
    'as' => 'PublicarVenta'
]);

Route::post('/ModificarProducto', [
    'uses' => 'App\Http\Controllers\AdminController@ModificarProducto',
    'as' => 'ModificarProducto'
]);

Route::post('/ModificarContrato', [
    'uses' => 'App\Http\Controllers\AdminController@ModificarContrato',
    'as' => 'ModificarContrato'
]);

Route::post('/VentasExternas', [
    'uses' => 'App\Http\Controllers\pedidoController@ActualizarEstado',
    'as' => 'ActualizarEstado'
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


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('verpdf',function(){

    $personas = persona::all();
    $data = [
        'personas' => $personas
    ];

    $pdf = PDF::loadView('prueba', $data);

    return $pdf->stream('usuario.pdf');
});

Route::get('reportesProductos',function(){

    $frutas = tipo_fruta::all();
    $data = [
        'frutas' => $frutas
    ];

    $pdf = PDF::loadView('reportesProductos', $data);

    return $pdf->stream('ReporteDeProductos.pdf');
});
