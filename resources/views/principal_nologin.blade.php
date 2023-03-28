@extends('plantillas/plantillaPreGral')

@section('title', 'Página principal')

@section('contenido')
    <link rel="stylesheet" href="css/principal.css">
    <div class="jumbotron jb-principal">
        <div class="container-fluid jumbotron-texto">
            <h1 class="display-3">Contenido a tu alcance</h1>
            <p class="lead">Descubre un mundo de películas!</p>
        </div>
    </div>

    <br>

    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">

                <div class="d-block elemento-carousel">
                    <div class="container">

                    </div>
                </div>
            </div>
            <div class="carousel-item">

                <div class="d-block elemento-carousel">
                    <div class="container"></div>
                </div>
            </div>
            <div class="carousel-item">

                <div class="d-block elemento-carousel">
                    <div class="container"></div>

                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="container">
        <h2 class="mt-3">Populares</h2>



        <div class="row">

            @foreach ($popularMovies as $movie)
                <div class="col">
                    <x-movie-card-muestra :movie="$movie"/>
                </div>
                @if ($loop->index==6)
                    @break
                @endif
            @endforeach



        </div>
    </div>


@endsection
