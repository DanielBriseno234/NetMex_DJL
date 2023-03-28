<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\FavoritosController;
use App\Http\Controllers\PrePincipalController;
use App\Http\Controllers\HistorialController;

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

Route::get('/',[PrePincipalController::class, 'index'])->name('pre-principal');          //Ruta a la pagina principal antes de hacer login
Route::view('/login', "login")->name('login');          //Ruta a la pagina de login
Route::view('/registro', "register")->name('registro'); //Ruta a la pagina de registro
//Route::view('/principal', "principal")->middleware('auth')->name('principal');     //Ruta a la pagina principal
Route::view('/detalles', "detalles_pelicula")->middleware('auth')->name('detalles-pelicula');     //Ruta a la pagina de detalles
Route::get('/principal', [MoviesController::class, 'index'])->middleware('auth')->name('principal');
Route::get('/principal/{movie}',[MoviesController::class, 'show'])->middleware('auth')->name('principal.show');
                                                                            //El metodo middleware sirve para proteger
                                                                            //la página, ya que para ingresar a ella
                                                                            //valida si esta una sesión activa, sino hay
                                                                            //una activa lo redirecciona al login

Route::post('/validar-registro', [ LoginController::class, 'register'])->name('validar-registro'); //Ruta para validar los datos ingresados
Route::post('/inicia-sesion', [ LoginController::class, 'login'])->name('inicia-sesion');       //Ruta cuando uno inicia sesión
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');      //Ruta cuando uno presiona el cerrar sesion

Route::get('/favoritos/eliminar/{id}',[FavoritosController::class, 'destroy'])->middleware('auth')->name('favoritos.destroy');
Route::get('/favoritos/guardar/{id}',[FavoritosController::class, 'store'])->middleware('auth')->name('favoritos.store');//Ruta para guartdar una lista de favotritos
Route::get('/favoritos',[FavoritosController::class, 'index'])->middleware('auth')->name('favoritos.index');//Ruta para mostrar la lista de favoritos

Route::get('/historial',[HistorialController::class, 'index'])->middleware('auth')->name('historial.index');//Ruta para mostrar la lista de historial
