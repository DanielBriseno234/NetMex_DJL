<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class prePincipalController extends Controller
{
    public function index()
    {
        $popularMovies = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/movie/popular?&language=es-MX')
        ->json()['results'];

        $upcomingMovies = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/movie/upcoming?&language=es-MX')
        ->json()['results'];

        return view('principal_nologin',['popularMovies'=>$popularMovies, 'upcomingMovies'=>$upcomingMovies]);
    }
}