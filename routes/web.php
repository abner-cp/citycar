<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\MarcaController;

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
    return view('auth.login');
});

/*
Route::get('/vehiculo', function () {
    return view('vehiculo/index');
});

Route::get('/vehiculo/create', [VehiculoController::class, 'create']);
*/

Route::resource('vehiculo', VehiculoController::class)->middleware('auth'); //genera acceso a las vistas desde el controlador y sus metodos, se debe cumplir con auth antes
Route::resource('marca', MarcaController::class)->middleware('auth'); //genera acceso a las vistas desde el controlador y sus metodos, se debe cumplir con auth antes

Auth::routes(['register'=>false, 'reset'=>false]); //deshabilito opcion de registro y recovery de pass

Route::get('/home', [VehiculoController::class, 'index'])->name('home');

//si el usuario se logea, me redirecciona al index de vehículos
Route::group(['middleware'=> 'auth'], function(){
    Route::get('/', [VehiculoController::class, 'index'])->name('home');
});
