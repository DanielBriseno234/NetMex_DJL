@extends('plantillas/plantillaGral')

@section('title', 'Historial')

@section('contenido')
    <link rel="stylesheet" href="css/principal.css">

    <h2 class="mt-3 mb-4 text-center">Historial</h2>

    @if (session('alert_error'))
        <div class="alert alert-danger">
            {{ session('alert') }}
        </div>
    @endif

    @if ($historyMovies != null)
    <div class="movieGrid">
            @foreach ($historyMovies as $movie)
                <div class="mb-3">
                    <x-movie-card :movie="$movie" />
                </div>
            @endforeach
    </div>
        @else
            <p class="text-center">No se encuentra historial!</p>
        @endif
@endsection
