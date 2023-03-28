<!-- Este es el contenido del correo electronico que llega del formulario de contacto-->
<!DOCTYPE html>
	<html>
	<head>
		<title></title>
	</head>
	<body>
		<p>Recibiste un mensaje del usuario <strong> {{ $msg['name'] }} </strong></p>
		<p><strong>Asunto: </strong> {{ $msg['asunto'] }} </p>
		<p><strong>Problema: </strong> {{ $msg['descripcion'] }} </p>
	</body>
	</html>