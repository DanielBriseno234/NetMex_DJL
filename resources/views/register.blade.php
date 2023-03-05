@extends('plantillas/plantillaLogin')

@section('title', 'Registro')

@section('contenido')

    <div class="page-header header-filter imagenLogin">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 ml-auto mr-auto">
              <div class="card card-login card2">
                <form class="form" method="POST" action="{{ route('validar-registro') }}">
                    @csrf
                  <div class="card-header card-header-primary text-center">
                    <h4 class="card-title">Registrarse</h4>
                  </div>
                  <div class="card-body">
                    <div class="marginInput">
                        <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="material-icons">mail</i>
                              </span>
                            </div>
                            <input type="email" class="form-control" placeholder="Email..." name="email" aria-describedby="emailHelp" value="{{ old('email') }}">
                        </div>
                        {!! $errors->first('email','<small class="error">:message</small>') !!}
                    </div>
                    
                    <div>
                        <div class="input-group marginInput">
                            <div class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="material-icons">lock_outline</i>
                              </span>
                            </div>
                            <input type="password" class="form-control" placeholder="Password..."  name="password">
                          </div>
                          {!! $errors->first('password','<small class="error">:message</small>') !!}
                    </div>

                    <div>
                        <div class="input-group marginInput">
                            <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="material-icons">blur_on</i>
                            </span>
                            </div>
                            <input type="text" class="form-control" placeholder="Nombre..." id="nombre" name="nombre" aria-describedby="emailHelp" value="{{ old('nombre') }}">
                       </div>
                       {!! $errors->first('nombre','<small class="error">:message</small>') !!}
                    </div>

                    <div>
                      <div class="input-group marginInput">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="material-icons">blur_on</i>
                          </span>
                        </div>
                        <input type="text" class="form-control" placeholder="Apellido Paterno..." id="apPaterno" name="apPaterno" aria-describedby="emailHelp" value="{{ old('apPaterno') }}">
                      </div>
                      {!! $errors->first('apPaterno','<small class="error">:message</small>') !!}
                    </div>

                    <div>
                        <div class="input-group marginInput">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="material-icons">blur_on</i>
                                </span>
                            </div>
                            <input type="text" class="form-control" id="apMaterno" placeholder="Apellido Materno..." name="apMaterno" aria-describedby="emailHelp" value="{{ old('apMaterno') }}">
                        </div>
                        {!! $errors->first('apMaterno','<small class="error">:message</small>') !!}
                    </div>

                    <div>
                      <div class="input-group marginInput">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="material-icons">face</i>
                          </span>
                        </div>
                        <input type="text" class="form-control" id="username" placeholder="Username..." name="username" aria-describedby="emailHelp" value="{{ old('username') }}">
                    </div>  
                        {!! $errors->first('username','<small class="error">:message</small>') !!}
                      </div>

                  </div>
                  <div class="footer text-center">
                    <button type="submit" class="btn btn-primary btn-link btn-wd btn-lg">Registrarse</button>
                    <p>Ya tengo cuenta <a href="{{ route('login') }}">Volver</a></p>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        
      </div>


@endsection