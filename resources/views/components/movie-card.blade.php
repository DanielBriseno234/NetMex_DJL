<div>
    <div class="pelicula-container">
        <a href="{{route('principal.show',$movie['id'])}}">
            <img class="pelicula-lista" src="{{ 'https://image.tmdb.org/t/p/w500/' . $movie['poster_path'] }}" alt="">
        </a>
        <div class="fondo-btn-fav"></div>
        <a href="{{route('favoritos.store',$movie['id'])}}">
            <button class="btn-fav"><i class="fa-solid fa-heart"></i></button>
        </a>
    </div>


    <div class="mt-2" class="descripcion-lista">
        <a href="{{route('principal.show',$movie['id'])}}" class="fw-semibold fs-6 titulo-lista">{{ $movie['title'] }}</a>
    </div>
</div>
