<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController; //Extension del controlador que se utiliza
use App\Http\Controllers\PerfilController; //Extension del controlador que se utiliza

Route::view('/login', "login")->name('login');          //Ruta a la pagina de login
Route::view('/registro', "register")->name('registro'); //Ruta a la pagina de registro
Route::view('/perfil', "perfil")->name('perfil')->middleware('auth');  //Ruta a la pagina de perfil
Route::view('/principal', "principal")->middleware('auth')->name('principal');     //Ruta a la pagina principal
                                                                            //El metodo middleware sirve para proteger
                                                                            //la página, ya que para ingresar a ella
                                                                            //valida si esta una sesión activa, sino hay
                                                                            //una activa lo redirecciona al login

Route::POST('/validar-registro', [ LoginController::class, 'register'])->name('validar-registro'); //Ruta para validar los datos ingresados
Route::POST('/inicia-sesion', [ LoginController::class, 'login'])->name('inicia-sesion');       //Ruta cuando uno inicia sesión
Route::POST('/perfil/cambiarImagen', [ PerfilController::class, 'store' ])->name('cambiar-imagen');  //Ruta cuando se presiona el cambiar imagen
Route::POST('/perfil/cambiarDatos', [ PerfilController::class, 'update' ])->name('modificar-datos');    //Ruta cuando se envia el formulario de modificar perfil
Route::POST('/perfil/cambiarContrasena', [ PerfilController::class, 'cambiarContrasena' ])->name('cambiar-contrasena'); //Ruta cuando se envia el formulario de 
                                                                                                                        //cambio de contraseña

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');      //Ruta cuando uno presiona el cerrar sesion