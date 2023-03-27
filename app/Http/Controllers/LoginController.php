<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Extensiones de archivos que tenemos que utilizar para iniciar sesión
use App\Models\Lista;                       //Importamos el modelo de la lista
use App\Models\User;                        //Extension del modelo del usuario
use Illuminate\Support\Facades\Hash;        //Extension para encriptar la contraseña
use Illuminate\Support\Facades\Auth;        //Extension para la autenticacion
use Illuminate\Support\Facades\Http;        //Extension para la peticion Http


class LoginController extends Controller
{

    public function register(Request $request){
        //Principalmente es validar los datos se puede implementar lo del profe alex
        request()->validate([
            'nombre'=>'required',
            'apPaterno'=>'required',
            'apMaterno'=>'required',
            'username'=>'required|min:5',
            'email' => 'required|email',
            'password' => 'required|min:8|max:20',
        ],
        [
            'nombre.required' => 'Introduzca su nombre.',
            'apPaterno.required' => 'Introduzca su apellido paterno.',
            'apMaterno.required' => 'Introduzca su apellido materno.',
            'username.required' => 'Introduzca su username.',
            'username.min' => 'Debe de contener minimo 5 caracteres.',
            'email.required' =>'Introduzca un correo.',
            'email.email' => 'Introduzca un correo valido.',
            'password.required' => 'Introduzca su contraseña.',
            'password.min' => 'Debe de contener minimo 8 caracteres.',
            'password.max' => 'Debe de contener menos de 20 caracteres.',
        ]);

        $user = new User();                             //Crear un objeto del modelo

        //El el objeto aignamos los valores que vienen desde el formulario
        //Los datos se envian por el request y el nombre se determina por el atributo name del input en el formulario
        $user->nombre = $request->nombre;
        $user->apPaterno = $request->apPaterno;
        $user->apMaterno = $request->apMaterno;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password); //El hass::make sirve para generar la encriptacion

        $user->save();      //guardamos el objeto en la bd

        Auth::login($user);     //Con esto autenticamos al usuario ingresado

        //Creando listas del usuario

        $lista_fav = Http::withToken(config('services.tmdb.token'))//Se hace un POST y se obtiene la respuesta
        ->post('https://api.themoviedb.org/3/list', [
            'name' => 'djl_fav_'.Auth::id(),
            'description' => 'Lista de favoritos de usuario con id '.Auth::id(),
            'language' => 'es-MX'
        ])
        ->json();

        $lista_his = Http::withToken(config('services.tmdb.token'))//Se hace un POST y se obtiene la respuesta X2
        ->post('https://api.themoviedb.org/3/list', [
            'name' => 'djl_his_'.Auth::id(),
            'description' => 'Lista de historial de usuario con id '.Auth::id(),
            'language' => 'es-MX'
        ])
        ->json();

        $userId = Auth::id();//Se obtiene el Id del usuario mediante Auth;

        Lista::create([//Se inserta la lista a la
			'user_id' => $userId,
			'favoritos_id' => $lista_fav['list_id'],
			'historial_id' => $lista_his['list_id']
		]);

        return redirect(route('principal'));  //Redireccion a la pagina principal
    }

    public function login(Request $request){
        //De igual forma debe de haber una validación de datos
        request()->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ],
        [
            'email.required' =>'Introduzca un correo.',
            'email.email' => 'Introduzca un correo valido.',
            'password.required' => 'Introduzca su contraseña.',
            'password.min' => 'Debe de contener minimo 8 caracteres.',
        ]);


        //Estas son los datos de inicio de sesion, por ende es el email y la contaseña
        $credentials = [
            "email" => $request->email,
            "password" => $request->password,
            //"active" => true
        ];

        //Esta parte sirve en el momento en el que el usuario marca que quiere tener la sesion iniciada
        //si la marca se asigna como true, sino pues se mantiene false
        $remember = ($request->has('remember') ? true : false);

        //Esto sirve para que se haga un intento de inicio de sesión automatico
        //Si las credenciales estan y se marca la opcion de mantener la sesion
        //el sistema accede automaticamente
        if(Auth::attempt($credentials, $remember)){
            $request->session()->regenerate();      //aqui borra las sesiones anteriores, en caso de haber mantenido una perdida

            //Esto ayuda en dado caso que intente ingresar a cualquier página desde la url
            return redirect()->intended(route('principal'));  //Si quiere ingresar a una diferente de la principal lo puede hacer
                                                            //Pero tiene que iniciar sesión, si no hace esto lo manda por default a la principal
        }else{ //Si el usuario no tiene las credenciales y no marca la casilla de mantener la sesion, lo redirecciona al login
            return redirect(route('login'));
        }

    }

    public function logout(Request $request){
        Auth::logout(); //Con este metodo simplemente cierra la sesion iniciada

        $request->session()->invalidate();  //Destruye la sesión
        $request->session()->regenerate();  //Y la elimina

        return redirect(route('login'));    //Redirección a la pagina del login
    }
}

?>
