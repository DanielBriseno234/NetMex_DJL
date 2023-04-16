<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;        //Extension para la autenticacion
use Illuminate\Support\Facades\Http;        //Extension para la peticion Http
use App\Models\Lista;                       //Modelo de la lista
use Exception;
use Illuminate\Pagination\Paginator;        //Extencion del paginador
use Illuminate\Support\Collection;          //Extension de las colecciones
use Illuminate\Pagination\LengthAwarePaginator; //Extenion del paginador de longitud dinamica

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $popularMovies = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/movie/popular?&language=es-MX')
        ->json()['results'];//Se obtienen resultados de las peliculas mas populares


        $topMovies = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/movie/top_rated?&language=es-MX')
        ->json()['results'];//Se obtienen los resultados de las peliculas mejor calificadas



        /*Se obtienen los favoritos*/
        $id_usuario = Auth::id(); //id del usuario

        $lista = Lista::where('user_id', $id_usuario)->first();//Se obtiene la lista con el id del usuario

        $id_lista = $lista['favoritos_id'];//Se saca el id de la lista en la API

        $favoriteMovies = Http::withToken(config('services.tmdb.token'))//Se obtienen los elementos de la lista
        ->get('https://api.themoviedb.org/3/list/'.$id_lista.'?&language=es-MX')
        ->json();

        //Se añade el campo de [favorite] a cada pelicula mediante una funcion
        $topMovies = $this->añadirFavorito($favoriteMovies, $topMovies);
        $popularMovies = $this->añadirFavorito($favoriteMovies, $popularMovies);

        //Se crea una paginacion mediante una funcion

        $paginatedPopularMovies = $this->paginate($popularMovies);
        $paginatedTopMovies = $this->paginate($topMovies);

        return view('principal',['popularMovies'=>$paginatedPopularMovies,'topMovies'=>$paginatedTopMovies] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/movie/'.$id.'?append_to_response=credits,videos,images&language=es-MX')
        ->json();

        $this->añadirHistorial($id);

        return view('detalles_pelicula')->with('movie',$movie);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function añadirHistorial($id){
        $id_usuario = Auth::id(); //id del usuario

        $lista = Lista::where('user_id', $id_usuario)->first();;//Se obtiene la lista con el id del usuario

        $id_lista = $lista['historial_id'];//Se saca el id de la lista en la API

        $resultado = Http::withToken(config('services.tmdb.token'))//Se hace un POST y se obtiene la respuesta
        ->post('https://api.themoviedb.org/3/list/'.$id_lista.'/add_item', [
            'media_id' => $id //En este caso $id es el id de la pelicula en la API
        ])
        ->json();

        if (!$resultado['status_code']==201) {
            return redirect()->back()->with('alert_error', 'Error al añadir historial!');
        }
    }

    //Funcion para añadir el campo de favorito a cualquier lista e  peliculas regresada por la API
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

    public function paginate($items, $perPage = 20, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
