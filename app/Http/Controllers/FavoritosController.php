<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;        //Extension para la autenticacion
use Illuminate\Support\Facades\Http;        //Extension para la peticion Http
use App\Models\Lista;                       //Modelo de la lista

class FavoritosController extends Controller
{
    public function index(){
        $id_usuario = Auth::id(); //id del usuario

        $lista = Lista::where('user_id', $id_usuario)->first();//Se obtiene la lista con el id del usuario

        $id_lista = $lista['favoritos_id'];//Se saca el id de la lista en la API

        $favoriteMovies = Http::withToken(config('services.tmdb.token'))//Se obtienen los elementos de la lista
        ->get('https://api.themoviedb.org/3/list/'.$id_lista.'?&language=es-MX')
        ->json();

        if($favoriteMovies['item_count']==0){
            $favoriteMovies = null;
        }else{
            foreach ($favoriteMovies['items'] as $key=> $favMovie) {
                $favoriteMovies['items'][$key] += ['favorite' => true];
            }

            $favoriteMovies = $favoriteMovies['items'];
        }

        return view('favoritos',['favoriteMovies'=>$favoriteMovies]);
    }

    public function store($id)
    {
        $id_usuario = Auth::id(); //id del usuario

        $lista = Lista::where('user_id', $id_usuario)->first();;//Se obtiene la lista con el id del usuario

        $id_lista = $lista['favoritos_id'];//Se saca el id de la lista en la API

        $resultado = Http::withToken(config('services.tmdb.token'))//Se hace un POST y se obtiene la respuesta
        ->post('https://api.themoviedb.org/3/list/'.$id_lista.'/add_item', [
            'media_id' => $id //En este caso $id es el id de la pelicula en la API
        ])
        ->json();

        if (!$resultado['status_code']==201) {
            return redirect()->back()->with('alert_error', 'Error al añadir favoritos!');
        }

        return redirect()->back();
    }

    public function destroy($id)
    {
        $id_usuario = Auth::id(); //id del usuario

        $lista = Lista::where('user_id', $id_usuario)->first();;//Se obtiene la lista con el id del usuario

        $id_lista = $lista['favoritos_id'];//Se saca el id de la lista en la API

        $resultado = Http::withToken(config('services.tmdb.token'))//Se hace un POST y se obtiene la respuesta
        ->post('https://api.themoviedb.org/3/list/'.$id_lista.'/remove_item', [
            'media_id' => $id //En este caso $id es el id de la pelicula en la API
        ])
        ->json();

        if (!$resultado['status_code']==200) {
            return redirect()->back()->with('alert_error', 'Error al remover favoritos!');
        }

        return redirect()->back();
    }
}
