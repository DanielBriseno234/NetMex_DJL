@extends('plantillas/plantillaGral')

@section('title', 'Contacto')
<!-- Formulario de contacto -->
@section('contenido')
<link rel="stylesheet" href="{{asset('css/contacto.css')}}">
<div class="container">
		<div class="contact-box">
			<div class="left"></div>
			<div class="right">
				<h2>Contactanos</h2>
				<form method="post" action="{{ route('contacto') }}">
				@csrf
        <!--Mensaje de error en caso de no cumplir los requerimientos-->
				<div id="contac" style="color:black;">{!! $errors->first('name','<small>:message</small>')!!}</div>
				<input type="text" name="name" class="field" placeholder="Usuario" value="{{ old('name') }}"><br>
				<!--Mensaje de error en caso de no cumplir los requerimientos-->
				<div style="color:black;">{!! $errors->first('asunto','<small>:message</small><br>') !!}</div>
				<input type="text" name="asunto" class="field" placeholder="Asunto" value="{{ old('asunto') }}"><br>
        <!--Mensaje de error en caso de no cumplir los requerimientos-->
				<div style="color:black;">{!! $errors->first('descripcion','<small>:message</small><br>') !!}</div>
				<textarea placeholder="Mensaje" name="descripcion" class="field">{{ old('descripcion') }}</textarea><br>
				<button class="btn" id="myButton">Enviar</button>
				</form>
			</div>
		</div>
	</div>

  @include('components.footer')

<script type="text/javascript">
const button = document.getElementById("myButton");

button.addEventListener("click", function() {
  // Crea la alerta
  const alert = document.createElement("div");
  alert.classList.add("alert");
  alert.innerHTML = "El correo se enviara en unos segundos";
  
  // Crea el botón para cerrar la alerta
  const closeBtn = document.createElement("span");
  closeBtn.classList.add("close-btn");
  closeBtn.innerHTML = "&times;";
  alert.appendChild(closeBtn);
  
  // Añade la alerta al documento
  document.body.appendChild(alert);
  
  // Tiempo para cerrar la alerta
  setTimeout(function() {
    alert.remove();
  }, 10000);
  
  // Cierra la alerta al hacer clic en el botón
  closeBtn.addEventListener("click", function() {
    alert.remove();
  });
});


</script>
@endsection
