@extends('plantillas/plantillaGral')

@section('title', 'Favoritas')

@section('contenido')
    <link rel="stylesheet" href="css/principal.css">


    <h2 class="mt-3 mb-4 text-center">Favoritos</h2>

    @if (session('alert_error'))
        <div class="alert alert-danger">
            {{ session('alert') }}
        </div>
    @endif

    @if ($favoriteMovies != null)
        <div class="movieGrid">
            @foreach ($favoriteMovies as $movie)
                <div class="mb-3">
                    <x-movie-card :movie="$movie" />
                </div>
            @endforeach
        </div>
    @else
        <p class="text-center" style="grid-column: 1/5">No se encuentran favoritos!</p>
    @endif


@endsection
