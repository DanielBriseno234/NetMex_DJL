@extends('plantillas/plantillaGral')

@section('title', 'Detalles Película')

@section('estilos')
    <link rel="stylesheet" href="{{asset('css/detalles_pelicula.css')}}">
@endsection

@section('contenido')

    <div class="container mt-5">

        <div class="row ">
            <div class="col-lg-3">
                <img class="pelicula-lista" src="{{ 'https://image.tmdb.org/t/p/w200/' . $movie['poster_path'] }}"
                    alt="">
            </div>

            <div class="col-lg-9" style="">
                <div class="detalles">
                    <p class="fw-swmibold fs-3">{{ $movie['title'] }}</p>
<p class="fs-5">Géneros</p>
                    <p >
                        @foreach ($movie['genres'] as $genre)
                            {{$genre['name']}}@if(!$loop->last),@endif
                        @endforeach
                    </p>
                    <p class="fs-5">Actores</p>

                    @php
                    {{
                        $creditos = $movie['credits'];
                        $cast = $creditos['cast'];
                        $videos = $movie['videos'];
                        $videos_result = $videos['results'];
                    }}

                    @endphp
                    @foreach ($cast as $actor)
                        {{$actor['name']}},
                    @endforeach

                    <p class="mt-3 fs-5">Descripción</p>

                    <p>{{$movie['overview']}}</p>
                </div>
            </div>
        </div>

        <div class="container">
            @foreach ($videos_result as $video)
                @if($video['type']=="Trailer")
                    <center>
                        <iframe  id="reproductor" src="https://www.youtube.com/embed/{{$video['key']}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </center>
                    @break
                @endif
            @endforeach


        </div>
    </div>

@endsection
