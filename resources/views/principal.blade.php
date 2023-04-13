@extends('plantillas/plantillaGral')

@section('title', 'Página principal')

@section('contenido')
    <link rel="stylesheet" href="css/principal.css">

    <div class="container">
        <h2 class="mt-3 mb-4 text-center">Populares</h2>

        @if (session('alert_error'))
            <div class="alert alert-error">
                {{ session('alert') }}
            </div>
        @endif

        <div class="row">
            @foreach ($popularMovies as $movie)
                <div class="col-2 mb-3">
                    <x-movie-card :movie="$movie" />
                </div>
            @endforeach

        </div>

    <h2 class="mt-3 mb-4 text-center">Mejor calificadas</h2>
    <div class="row">

        @foreach ($topMovies as $movie)
            <div class="col-2 mb-3">
                <x-movie-card :movie="$movie" />
            </div>
    @endforeach

</div>
</div>

    @include('components.footer')

@endsection
