<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;        //Extension para encriptar la contraseña
use Illuminate\Support\Facades\Auth;        //Extension para la autenticacion   
use DB;
use RealRashid\SweetAlert\Facades\Alert;

class PerfilController extends Controller
{
    public function store(Request $request){
        $user =  Auth::user();

        if($request -> hasfile('imagen') ){
            $file = $request->file('imagen');
            $destinationPath = 'img/imgPerfil/';
            $filename = time(). "-" . $file->getClientOriginalName();
            $uploadSuccess = $request->file('imagen')->move($destinationPath, $filename);
        }

        $sqlDB = DB::table('users')
                        ->where('id', $user->id)
                        ->update(array('imagen'=> $uploadSuccess));

        //dd( $request ->hasfile('features') );
        
        return redirect()->back();
    }

    public function update(Request $request){
        $user =  Auth::user();

        request()->validate([
            'nombre'=>'required',
            'apPaterno'=>'required',
            'apMaterno'=>'required',
            'username'=>'required|min:5',
            'email' => 'required|email'
        ],
        [
            'nombre.required' => 'Introduzca su nombre.',
            'apPaterno.required' => 'Introduzca su apellido paterno.',
            'apMaterno.required' => 'Introduzca su apellido materno.',
            'username.required' => 'Introduzca su username.',
            'username.min' => 'Debe de contener minimo 5 caracteres.',
            'email.required' =>'Introduzca un correo.',
            'email.email' => 'Introduzca un correo valido.',
        ]);
        
        $sqlDB = DB::table('users')
                        ->where('id', $user->id)
                        ->update(['nombre'=> $request->nombre, 
                                  'apPaterno'=> $request->apPaterno, 
                                  'apMaterno'=> $request->apMaterno, 
                                  'username'=> $request->username, 
                                  'email'=> $request->email
                                ]);

        //dd( $request ->hasfile('features') );

        if($sqlDB == 1){
            alert()->success('Modificación de datos exitosa', 'La información personal fue modificada con éxito');
        }else{
            alert()->success('No se modificó ningún registro', 'No detectamos el ingreso de un dato deferente a los registrados');
        }

        

        return redirect()->back();
    }

    public function cambiarContrasena(Request $request){
        request()->validate([
            'passActual'=>'required',
            'passNueva'=>'required',
            'passConfirmar'=>'required'
        ],
        [
            'passActual.required' => 'Este campo no puede estar vacío.',
            'passNueva.required' => 'Este campo no puede estar vacío.',
            'passConfirmar.required' => 'Este campo no puede estar vacío.'
        ]);
        
        $user =  Auth::user();
        $idUser = $user->id;
        $emailUser = $user->email;
        $passUser = $user->password;

        if($request->passActual != ""){
            $nuevoPass = $request->passNueva;
            $confirmPass = $request->passConfirmar;

            if(Hash::check($request->passActual, $passUser)){
                if($nuevoPass === $confirmPass){
                    echo 
                    $user->password = Hash::make($request->passNueva);
                    $sqlDB = DB::table('users')
                        ->where('id', $user->id)
                        ->update(array('password'=> $user->password));
                        
                    alert()->success('Modificación de contraseña exitosa','La contraseña se modificó correctamente');
                    return redirect()->back()->with('updatePass', 'Contraseña cambiada exitosamente');
                }else{
                    alert()->error('Error de contraseña','La nueva contraseña no coincide con la contraseña de confirmación');
                    return redirect()->back()->withError('errorDiferente', 'Las contraseñas no son iguales');
                }
            }else{
                alert()->error('Error de contraseña','La contraseña actual es incorrecta.');
                return redirect()->back()->withError('errorActual', 'La contraseña actual es incorrecta');
            }
        }
    }

}
