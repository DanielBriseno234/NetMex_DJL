<?php

/* 
CREADO POR: Daniel Briseño
FECHA CREACIÓN: 10/03/2023
DESCRIPCIÓN: Controlador correspondiente a los cambios del perfil
*/

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;                        //Extensión del modelo que se esta utilizando
use Illuminate\Support\Facades\Hash;        //Extension para encriptar la contraseña
use Illuminate\Support\Facades\Auth;        //Extension para la autenticacion   
use DB;
use RealRashid\SweetAlert\Facades\Alert;

class PerfilController extends Controller
{
    //Metodo para actualizar foto de perfiel de ususario
    public function store(Request $request){
        $user =  Auth::user(); //En una variable asignamos el usuario que tiene la sesion activa

        if($request -> hasfile('imagen') ){ //Si la petición tiene un dato de tipo file
            $file = $request->file('imagen');   //Se guarda en una variable el archivo
            $destinationPath = 'img/imgPerfil/';    //Se guarda en una variable la direccion de destino
            $filename = time(). "-" . $file->getClientOriginalName();   //Se asigna el nombre del archivo
            $uploadSuccess = $request->file('imagen')->move($destinationPath, $filename); //Se guarda la imagen
        }

        //Actualizamos la tabla en la base de datos para guardar la dirección en donde se guardo la imagen
        $sqlDB = DB::table('users')
                        ->where('id', $user->id)
                        ->update(array('imagen'=> $uploadSuccess));

        //dd( $request ->hasfile('features') );
        
        return redirect()->back();  //Retornamos al usuario a la pagina en donde estaba
    }

    //Función para actualizar los datos del usuario
    public function update(Request $request){
        $user =  Auth::user();  //En una variable asignamos el usuario que tiene la sesion activa

        //Principalmente es validar los datos se puede implementar lo del profe alex
        request()->validate([
            'nombre'=>'required',
            'apPaterno'=>'required',
            'apMaterno'=>'required',
            'username'=>'required|min:5',
            'email' => 'required|email'
        ],
        [
            //Estos son los mensajes que se mostrarán en caso de no cumplir con las reglas
            'nombre.required' => 'Introduzca su nombre.',
            'apPaterno.required' => 'Introduzca su apellido paterno.',
            'apMaterno.required' => 'Introduzca su apellido materno.',
            'username.required' => 'Introduzca su username.',
            'username.min' => 'Debe de contener minimo 5 caracteres.',
            'email.required' =>'Introduzca un correo.',
            'email.email' => 'Introduzca un correo valido.',
        ]);
        
        //Realizamos una actualizaciín a la base de datos para guardar los datos que fueron ingresados
        //por el usuario
        $sqlDB = DB::table('users')
                        ->where('id', $user->id)
                        ->update(['nombre'=> $request->nombre, 
                                  'apPaterno'=> $request->apPaterno, 
                                  'apMaterno'=> $request->apMaterno, 
                                  'username'=> $request->username, 
                                  'email'=> $request->email
                                ]);

        //dd( $request ->hasfile('features') );

        //Validación para mostrar la alerta de la actualización
        if($sqlDB == 1){    //Si la consulta retorna un 1
            //Se muestra una alerta de que se realizo correctamente
            alert()->success('Modificación de datos exitosa', 'La información personal fue modificada con éxito');
        }else{
            //Si retorna otro valor se muestra una alerta de que no se realizo ninguna modificacion
            //debido a que el usuario no cambio ningnu dato pero envio el formulario
            alert()->success('No se modificó ningún registro', 'No detectamos el ingreso de un dato deferente a los registrados');
        }

        return redirect()->back(); //Retornamos al usuario a la pagina en donde estaba
    }

    //Función para que el usuario pueda modificar su contraseña
    public function cambiarContrasena(Request $request){
        //Principalmente es validar los datos se puede implementar lo del profe alex
        request()->validate([
            'passActual'=>'required',
            'passNueva'=>'required',
            'passConfirmar'=>'required'
        ],
        [
            //Estos son los mensajes que se mostrarán en caso de no cumplir con las reglas
            'passActual.required' => 'Este campo no puede estar vacío.',
            'passNueva.required' => 'Este campo no puede estar vacío.',
            'passConfirmar.required' => 'Este campo no puede estar vacío.'
        ]);
        
        $user =  Auth::user(); //En una variable asignamos el usuario que tiene la sesion activa
        // Guardamos los datos de esa sesion en variables diferentes
        $idUser = $user->id;
        $emailUser = $user->email;
        $passUser = $user->password;

        //Comenzamos a hacer las validaciones para el cabio de contraseña
        if($request->passActual != ""){ //Si la contraseña NO essta vacia
            $nuevoPass = $request->passNueva;   //Guardamos la contraseña nueva
            $confirmPass = $request->passConfirmar; //Guardamos la confirmación de la contraseña

            if(Hash::check($request->passActual, $passUser)){ //Si la contraseña ingresada es igual a la actual
                if($nuevoPass === $confirmPass){    //Si la nueva contraseña es igual a la confirmacion de contraseñ<<a
                    echo 
                    $user->password = Hash::make($request->passNueva); //Encriptamos la contraseña y la guardamos en una variable
                    //Actualizamos la tabla del usuario y guardamos la contraseña nueva
                    $sqlDB = DB::table('users')
                        ->where('id', $user->id)
                        ->update(array('password'=> $user->password));
                        
                    //Mostramos una alerta de cambio de contraseña
                    //Regresamos al usuario a la página
                    alert()->success('Modificación de contraseña exitosa','La contraseña se modificó correctamente');
                    return redirect()->back()->with('updatePass', 'Contraseña cambiada exitosamente');
                }else{
                    //Si la nueva cotraseña no coincide con la confirmacion
                    //Se muestra alerta de error y retornamos al ususario a la pagina
                    alert()->error('Error de contraseña','La nueva contraseña no coincide con la contraseña de confirmación');
                    return redirect()->back()->withError('errorDiferente', 'Las contraseñas no son iguales');
                }
            }else{
                //Si la contraseña ingresada no coincide con la actual
                //Se muestra alerta de error y retornamos al usuario a la pagina
                alert()->error('Error de contraseña','La contraseña actual es incorrecta.');
                return redirect()->back()->withError('errorActual', 'La contraseña actual es incorrecta');
            }
        }
    }

}
