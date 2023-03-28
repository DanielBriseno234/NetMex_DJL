@extends('plantillas/plantillaGral')

@section('title', 'Nosotros')

@section('contenido')
<link rel="stylesheet" href="{{asset('css/nosotros.css')}}">
<!-- <div class="title-cards">
		
	</div>
<div class="container-card">
	
<div class="card">
	<figure>
		<img src="{{asset('img/mision.png')}}">
	</figure>
	<div class="contenido-card">
		<h3>Mision</h3>
		<p>Nuestra misión como empresa es ofrecer una experiencia de entretenimiento única y accesible a través de una amplia variedad de contenidos, incluyendo películas, series, documentales y programas de televisión</p>
		<a href="#">Leer Màs</a>
	</div>
</div>
<div class="card">
	<figure>
		<img src="{{asset('img/vision.png')}}">
	</figure>
	<div class="contenido-card">
		<h3>vision</h3>
		<p>Nuestra visión es ser la plataforma de streaming más reconocida y confiable del mundo, con una amplia variedad de contenidos para todos los gustos y preferencias, brindando una experiencia personalizada e innovadora a nuestros usuarios.</p>
		<a href="#">Leer Màs</a>
	</div>
</div>
<div class="card">
	<figure>
		<img src="{{asset('img/valor.png')}}">
	</figure>
	<div class="contenido-card">
		<h3>Valores</h3>
		<p>Nuestros valores como empresa es ofrecer una experiencia de entretenimiento única y accesible a través de una amplia variedad de contenidos, incluyendo películas, series, documentales y programas de televisión</p>
		<a href="#">Leer Màs</a>
	</div>
</div>
</div> -->
<!-- Se realiza una nevgador Tabs para la seccion de nosotros -->
<center>
<h2>Nosotros</h2>
</center>
<div class="container">
        <div class="lbl-menu">
            <label for="radio1">Mision</label>
            <label for="radio2">Vision</label>
            <label for="radio3">Valores</label>
            <label for="radio4">Nosotros</label>
        </div>
        
        <div class="content">
           
            <input type="radio" name="radio" id="radio1" checked>
            <div class="tab1">
                <p>Nuestra misión como empresa es ofrecer una experiencia de entretenimiento única y accesible a través de una amplia variedad de contenidos, incluyendo películas, series, documentales y programas de televisión</p>
                <a href="#">Leer Màs</a>
            </div>
            
            <input type="radio" name="radio" id="radio2">
            <div class="tab2">
                <p>Nuestra visión es ser la plataforma de streaming más reconocida y confiable del mundo, con una amplia variedad de contenidos para todos los gustos y preferencias, brindando una experiencia personalizada e innovadora a nuestros usuarios.</p>
                <a href="#">Leer Màs</a>
            </div>
            
            <input type="radio" name="radio" id="radio3">
            <div class="tab3">
                <p>Nuestros valores como empresa es ofrecer una experiencia de entretenimiento única y accesible a través de una amplia variedad de contenidos, incluyendo películas, series, documentales y programas de televisión</p>
                <a  href="#">Leer Màs</a>
            </div>
            
            <input type="radio" name="radio" id="radio4">
            <div class="tab4">
                <p>Bienvenidos a NetMex, una plataforma de streaming creada para ofrecerte la mejor experiencia de entretenimiento en línea. Nuestro objetivo es hacer que el acceso a tus programas de TV, películas y series favoritas sea más fácil y accesible que nunca.</p>
                <p>En NetMex, creemos que el entretenimiento debe ser una experiencia sin complicaciones. Por eso, hemos creado una plataforma intuitiva y fácil de usar que te permite explorar y descubrir nuevos contenidos con facilidad. Ya sea que estés buscando la última serie de moda, un clásico de la pantalla grande o contenido original exclusivo, encontrarás todo lo que necesitas en nuestra plataforma.</p>
                <h5><b> Tienes algun problema</b></h5><h6>Ponte en contacto</h6>
                <a  href="{{ route('contacto') }}">Presion aqui</a>
            </div>
        </div>
    </div>


@endsection