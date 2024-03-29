<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\FavoritosController;
use App\Http\Controllers\PrePincipalController;
use App\Http\Controllers\HistorialController;
use App\Http\Controllers\LoginController; //Extension del controlador que se utiliza
use App\Http\Controllers\PerfilController; //Extension del controlador que se utiliza
use App\Http\Controllers\MessagesController;

Route::get('/',[PrePincipalController::class, 'index'])->name('pre-principal');          //Ruta a la pagina principal antes de hacer login
Route::view('/login', "login")->name('login');          //Ruta a la pagina de login
Route::view('/registro', "register")->name('registro'); //Ruta a la pagina de registro
//Route::view('/principal', "principal")->middleware('auth')->name('principal');     //Ruta a la pagina principal
Route::view('/detalles', "detalles_pelicula")->middleware('auth')->name('detalles-pelicula');     //Ruta a la pagina de detalles
Route::get('/principal', [MoviesController::class, 'index'])->middleware('auth')->name('principal');
Route::get('/principal/{movie}',[MoviesController::class, 'show'])->middleware('auth')->name('principal.show');
Route::view('/nosotros', "nosotros")->middleware('auth')->name('nosotros'); //Ruta de la pagina nosotros.
Route::view('/contacto', "contacto")->middleware('auth')->name('contacto');  //Ruta de la pagina contacto.
Route::view('/perfil', "perfil")->name('perfil')->middleware('auth');  //Ruta a la pagina de perfil
                                                                            //El metodo middleware sirve para proteger
                                                                            //la página, ya que para ingresar a ella
                                                                            //valida si esta una sesión activa, sino hay
                                                                            //una activa lo redirecciona al login

Route::post('/validar-registro', [ LoginController::class, 'register'])->name('validar-registro'); //Ruta para validar los datos ingresados
Route::post('/inicia-sesion', [ LoginController::class, 'login'])->name('inicia-sesion');       //Ruta cuando uno inicia sesión
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');      //Ruta cuando uno presiona el cerrar sesion
Route::post('/contacto',[MessagesController::class, 'store']); //Ruta de la funcion de contacto.
Route::POST('/perfil/cambiarImagen', [ PerfilController::class, 'store' ])->name('cambiar-imagen');  //Ruta cuando se presiona el cambiar imagen
Route::POST('/perfil/cambiarDatos', [ PerfilController::class, 'update' ])->name('modificar-datos');    //Ruta cuando se envia el formulario de modificar perfil
Route::POST('/perfil/cambiarContrasena', [ PerfilController::class, 'cambiarContrasena' ])->name('cambiar-contrasena'); //Ruta cuando se envia el formulario de 
                                                                                                                        //cambio de contraseña
Route::get('/favoritos/eliminar/{id}',[FavoritosController::class, 'destroy'])->middleware('auth')->name('favoritos.destroy');
Route::get('/favoritos/guardar/{id}',[FavoritosController::class, 'store'])->middleware('auth')->name('favoritos.store');//Ruta para guartdar una lista de favotritos
Route::get('/favoritos',[FavoritosController::class, 'index'])->middleware('auth')->name('favoritos.index');//Ruta para mostrar la lista de favoritos
Route::get('/historial',[HistorialController::class, 'index'])->middleware('auth')->name('historial.index');//Ruta para mostrar la lista de historial

