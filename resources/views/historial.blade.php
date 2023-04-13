@extends('plantillas/plantillaGral')

@section('title', 'Página principal')

@section('contenido')
    <link rel="stylesheet" href="css/principal.css">

    <div class="container">
        <h2 class="mt-3 mb-4 text-center">Historial</h2>

        @if (session('alert_error'))
            <div class="alert alert-danger">
                {{ session('alert') }}
            </div>
        @endif

        <div class="row">
            @if ($historyMovies != null)
                @foreach ($historyMovies as $movie)
                    <div class="col mb-3">
                        <x-movie-card :movie="$movie" />
                    </div>
                @endforeach
            @else
                <p class="text-center">No se encuentra historial!</p>
            @endif
        </div>
    </div>

@endsection
