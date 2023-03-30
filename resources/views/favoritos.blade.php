@extends('plantillas/plantillaGral')

@section('title', 'Página principal')

@section('contenido')
    <link rel="stylesheet" href="css/principal.css">

    <div class="container">
        <h2 class="mt-3">Favoritos</h2>

        @if (session('alert_error'))
            <div class="alert alert-danger">
                {{ session('alert') }}
            </div>
        @endif

        <div class="row">
            @if ($favoriteMovies != null)
                @foreach ($favoriteMovies as $movie)
                    <div class="col">
                        <x-movie-card :movie="$movie" />
                    </div>
                @endforeach
            @else
                <p>No se encuentran favoritos!</p>
            @endif
        </div>
    </div>

@endsection
