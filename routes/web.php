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

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/changepassword', [App\Http\Controllers\HomeController::class, 'changePassword'])->name('changepassword');
Route::post('/updatepassword', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('updatepassword');

Route::get('send-email', function(){
$mailData = [
    "name" => "Test NAME",
    "dob" => "12/12/1990"
];
Mail::to("hello@example.com")->send(new TestEmail($mailData));
dd("Mail Sent Successfuly!");
});


// * Rutas para los usuarios
Route::GET('/userindex', [App\Http\Controllers\UserController::class, 'index'])->name('userindex');
Route::GET('/usershow/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('usershow');
Route::POST('/userupdate/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('userupdate');
Route::GET('/userdelete/{id}', [App\Http\Controllers\UserController::class, 'delete'])->name('userdelete');