<!-- CREADO POR: Daniel Briseño -->
<!-- FECHA CREACIÓN: 10/03/2023-->
<!-- DESCRIPCIÓN: Formulario de registro para usuario -->

<!-- Extension de la plantilla para este diseño -->
@extends('plantillas/plantillaLogin')

<!-- Extension para colocar el titulo a este diseño -->
@section('title', 'Registro')

<!-- Extension para colocar los estilos a este diseño  -->
@section('estilos')
  <link rel="stylesheet" href="css/login.css">
@endsection

<!-- Extensión para colocar todo el contenido correspondiente a este diseño -->
@section('contenido')
    <div class="page-header header-filter imagenLogin">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 ml-auto mr-auto">
              <div class="card card-login card2">
                <!-- Comienzo del formulario para realizar un registro de usuario -->
                <form class="form" method="POST" action="{{ route('validar-registro') }}">
                    @csrf <!-- Este comando ayuda para informar a laravel que el formulario esta validado por el usuario -->
                  <div class="card-header card-header-primary text-center">
                    <h4 class="card-title">Registrarse</h4>
                  </div>
                  <div class="card-body">
                    <div class="marginInput">
                        <div class="input-group">
                            <div class="input-group-prepend">
                              <!-- Campo para ingresar el email -->
                              <span class="input-group-text">
                                <i class="material-icons">mail</i>
                              </span>
                            </div>
                            <input type="email" class="form-control" placeholder="Email..." name="email" aria-describedby="emailHelp" value="{{ old('email') }}">
                        </div>
                        <!-- Captura de error -->
                        {!! $errors->first('email','<small class="error">:message</small>') !!}
                    </div>
                    
                    <div>
                        <div class="input-group marginInput">
                            <div class="input-group-prepend">
                              <!-- Campo para ingresar la contraseña -->
                              <span class="input-group-text">
                                <i class="material-icons">lock_outline</i>
                              </span>
                            </div>
                            <input type="password" class="form-control" placeholder="Password..."  name="password">
                          </div>
                          <!-- Captura de error -->
                          {!! $errors->first('password','<small class="error">:message</small>') !!}
                    </div>

                    <div>
                        <div class="input-group marginInput">
                            <div class="input-group-prepend">
                              <!-- Campo para ingresar el nombre -->
                            <span class="input-group-text">
                                <i class="material-icons">blur_on</i>
                            </span>
                            </div>
                            <input type="text" class="form-control" placeholder="Nombre..." id="nombre" name="nombre" aria-describedby="emailHelp" value="{{ old('nombre') }}">
                       </div>
                       <!-- Captura de error -->
                       {!! $errors->first('nombre','<small class="error">:message</small>') !!}
                    </div>

                    <div>
                      <div class="input-group marginInput">
                        <div class="input-group-prepend">
                          <!-- Campo para ingresar el Apellido paterno -->
                          <span class="input-group-text">
                            <i class="material-icons">blur_on</i>
                          </span>
                        </div>
                        <input type="text" class="form-control" placeholder="Apellido Paterno..." id="apPaterno" name="apPaterno" aria-describedby="emailHelp" value="{{ old('apPaterno') }}">
                      </div>
                      <!-- Captura de error -->
                      {!! $errors->first('apPaterno','<small class="error">:message</small>') !!}
                    </div>

                    <div>
                        <div class="input-group marginInput">
                            <div class="input-group-prepend">
                              <!-- Campo para ingresar el apellido materno -->
                                <span class="input-group-text">
                                    <i class="material-icons">blur_on</i>
                                </span>
                            </div>
                            <input type="text" class="form-control" id="apMaterno" placeholder="Apellido Materno..." name="apMaterno" aria-describedby="emailHelp" value="{{ old('apMaterno') }}">
                        </div>
                        <!-- Captura de error -->
                        {!! $errors->first('apMaterno','<small class="error">:message</small>') !!}
                    </div>

                    <div>
                      <div class="input-group marginInput">
                        <div class="input-group-prepend">
                          <!-- Campo para ingresar el Usuario -->
                          <span class="input-group-text">
                            <i class="material-icons">face</i>
                          </span>
                        </div>
                        <input type="text" class="form-control" id="username" placeholder="Username..." name="username" aria-describedby="emailHelp" value="{{ old('username') }}">
                    </div>  
                    <!-- Captura de error -->
                        {!! $errors->first('username','<small class="error">:message</small>') !!}
                      </div>

                  </div>
                  <div class="footer text-center">
                    <!-- Boton para enviar el formulario -->
                    <button type="submit" class="btn btn-primary btn-link btn-wd btn-lg">Registrarse</button>
                    <!-- El usuario puede regresar al login -->
                    <p>Ya tengo cuenta <a href="{{ route('login') }}">Volver</a></p>
                  </div>
                </form>
                <!-- Fin del formulario para registro de usuario -->
              </div>
            </div>
          </div>
        </div>        
      </div>
@endsection