@extends('plantillas/plantillaGral')

@section('title', 'Página principal')

@section('contenido')
    <link rel="stylesheet" href="css/principal.css">

    <div class="container">
        <h2 class="mt-3">Populares</h2>

        @if (session('alert_error'))
            <div class="alert alert-error">
                {{ session('alert') }}
            </div>
        @endif

        <div class="row">
            @foreach ($popularMovies as $movie)
                <div class="col-2">
                    <x-movie-card :movie="$movie" />
                </div>
            @endforeach

        </div>

    <h2 class="mt-3">Mejor calificadas</h2>
    <div class="row">

        @foreach ($topMovies as $movie)
            <div class="col-2">
                <x-movie-card :movie="$movie" />
            </div>
    @endforeach

</div>
</div>

@endsection
