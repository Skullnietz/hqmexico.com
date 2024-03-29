<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestEmail;

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

Route::get('/', [App\Http\Controllers\InicioController::class, 'index'])->name('inicio');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/changepassword', [App\Http\Controllers\HomeController::class, 'changePassword'])->name('changepassword');
Route::post('/updatepassword', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('updatepassword');

Route::get('/usuarios', [App\Http\Controllers\UserController::class, 'index'])->name('usuarios');
Route::get('/usuario-crear', [App\Http\Controllers\UserController::class, 'create'])->name('usuarios-create');

Route::get('send-email', function(){
$mailData = [
    "name" => "Test NAME",
    "dob" => "12/12/1990"
];
Mail::to("hello@example.com")->send(new TestEmail($mailData));
dd("Mail Sent Successfuly!");
});

// * Rutas para Catalogo
Route::GET('/catalogo/categorias', [App\Http\Controllers\CatalogoController::class, 'categorias'])->name('categorias');
Route::GET('/catalogo/productos', [App\Http\Controllers\CatalogoController::class, 'productos'])->name('catalogoproductos');
Route::POST('/storecategorias', [App\Http\Controllers\CatalogoController::class, 'storecategorias'])->name('storecategorias');
Route::GET('/catalogo/secciones', [App\Http\Controllers\CatalogoController::class, 'secciones'])->name('secciones');
Route::GET('/deletesecciones/{seccion}', [App\Http\Controllers\CatalogoController::class, 'deletesecciones'])->name('deletesecciones');
Route::GET('/deletecategorias/{categoria}', [App\Http\Controllers\CatalogoController::class, 'deletecategorias'])->name('deletecategorias');
Route::GET('/updatecategoria', [App\Http\Controllers\CatalogoController::class, 'updatecategoria'])->name('deletecategoria');
Route::GET('/updateseccion', [App\Http\Controllers\CatalogoController::class, 'updateseccion'])->name('deleteseccion');
Route::POST('/storesecciones', [App\Http\Controllers\CatalogoController::class, 'storesecciones'])->name('storesecciones');
// * Rutas para los usuarios
Route::GET('/userindex', [App\Http\Controllers\UserController::class, 'userList'])->name('userindex');
Route::GET('/usershow/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('usershow');
Route::POST('/userupdate/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('userupdate');
Route::GET('/userdelete/{id}', [App\Http\Controllers\UserController::class, 'delete'])->name('userdelete');
Route::GET('/usersetactivo/{id}', [App\Http\Controllers\UserController::class, 'setActivo'])->name('usersetactivo');
Route::GET('/updatepassword/{id}', [App\Http\Controllers\UserController::class, 'newPassword'])->name('updatepassword');

// * Rutas para el newsletter
Route::GET('/newsletterindex', [App\Http\Controllers\NewsletterController::class, 'index'])->name('newsletterindex');
Route::GET('/newslettershow/{id}', [App\Http\Controllers\NewsletterController::class, 'show'])->name('newslettershow');
Route::POST('/newsletterstore', [App\Http\Controllers\NewsletterController::class, 'store'])->name('newsletterstore');
Route::GET('/newsletterupdate/{id}', [App\Http\Controllers\NewsletterController::class, 'update'])->name('newsletterupdate');
Route::GET('/newsletterdelete/{id}', [App\Http\Controllers\NewsletterController::class, 'delete'])->name('newsletterdelete');
Route::GET('/newsletterverificar/{id}', [App\Http\Controllers\NewsletterController::class, 'verificar'])->name('newsletterverificar');

Route::get('/newsletter/create', function(){return view('newsletter.create');});

// * Rutas para los productos
Route::group(['prefix' => 'productos'], function(){
    Route::GET('/', [App\Http\Controllers\ProductosController::class, 'Productoslist'])->name('productosindexview');
    Route::GET('index', [App\Http\Controllers\ProductosController::class, 'index'])->name('productosindex');
    Route::GET('create', [App\Http\Controllers\ProductosController::class, 'create'])->name('productoscreate');
    Route::GET('show/{id}', [App\Http\Controllers\ProductosController::class, 'show'])->name('productosshow');
    Route::POST('store', [App\Http\Controllers\ProductosController::class, 'store'])->name('productosstore');
    Route::POST('update/{id}', [App\Http\Controllers\ProductosController::class, 'update'])->name('productosupdate');
    Route::POST('delete/{id}', [App\Http\Controllers\ProductosController::class, 'delete'])->name('productosdelete');
    Route::GET('search/{input}', [App\Http\Controllers\ProductosController::class, 'search'])->name('productossearch');
    Route::GET('getCategorias', [App\Http\Controllers\ProductosController::class, 'getCategorias'])->name('productosgetcategorias');
    Route::GET('getCategoriasByID/{id}', [App\Http\Controllers\ProductosController::class, 'getCategoriasByID'])->name('productosgetcategoriasbyid');
    Route::GET('getCategoriasByName/{nombre}', [App\Http\Controllers\ProductosController::class, 'getCategoriasByName'])->name('productosgetcategoriasbyname');
});

// * Rutas para el catalogo
Route::group(['prefix' => 'catalogo'], function(){
    Route::GET('/', [App\Http\Controllers\CatalogoController::class, 'index'])->name('catalogo');
    Route::GET('/edit', [App\Http\Controllers\CatalogoController::class, 'edit'])->name('catalogoedit');
    Route::POST('/update', [App\Http\Controllers\CatalogoController::class, 'update'])->name('catalogoupdate');
    //Route::get('example', function(){return view('catalogo.index');})->name('catalogoexample');
    //Route::POST('export', [App\Http\Controllers\CatalogoController::class, 'exportCatalogo'])->name('catalogoexport');
    //Route::GET('productos', [App\Http\Controllers\CatalogoController::class, 'productos'])->name('catalogoproductos');
});
