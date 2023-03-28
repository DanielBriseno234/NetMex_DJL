<?php

namespace App\Http\Controllers;

use App\Models\Lista;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;        //Extension para la autenticacion
use Illuminate\Support\Facades\Http;        //Extension para la peticion Http

class HistorialController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_usuario = Auth::id(); //id del usuario

        $lista = Lista::where('user_id', $id_usuario)->first();//Se obtiene la lista con el id del usuario

        $id_historial = $lista['historial_id'];//Se saca el id de la lista en la API
        $id_favoritos = $lista['favoritos_id'];//Se saca el id de la lista en la API

        $historyMovies = Http::withToken(config('services.tmdb.token'))//Se obtienen los elementos de la lista
        ->get('https://api.themoviedb.org/3/list/'.$id_historial.'?&language=es-MX')
        ->json();

        $favoriteMovies = Http::withToken(config('services.tmdb.token'))//Se obtienen los elementos de la lista
        ->get('https://api.themoviedb.org/3/list/'.$id_favoritos.'?&language=es-MX')
        ->json();



        if($historyMovies['item_count']==0){
            $historyMovies = null;
        }else{
            //Se añade el campo de [favorite] a cada pelicula mediante una funcion
            $historyMovies['items'] = $this->añadirFavorito($favoriteMovies, $historyMovies['items']);
            $historyMovies = $historyMovies['items'];

        }

        return view('historial',['historyMovies'=>$historyMovies]);
    }

    public function store($id){

    }

    public function destroy($id)
    {

    }

    public function añadirFavorito($favoriteMovies, $anyMovies)
    {
        if($favoriteMovies != null || $favoriteMovies['item_count'] != 0){
            foreach ($anyMovies as $key=>$movie) {
                $esFav = false;

                foreach ($favoriteMovies['items'] as $favMovie) {
                    if($movie['id']==$favMovie['id']){
                        $esFav = true;
                    }
                }

                $anyMovies[$key] += ['favorite' => $esFav];
            }
        }else{
            foreach ($anyMovies as $movie) {
                $movie += ['favorite' => false];
            }
        }

        return $anyMovies;
    }
}
