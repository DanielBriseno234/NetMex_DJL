@extends('plantillas/plantillaLogin')

@section('title', 'Inicio de sesión')

@section('contenido')
<div class="page-header header-filter imagenLogin">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6 ml-auto mr-auto">
          <div class="card card-login">
            <form class="form" method="POST" action="{{ route('inicia-sesion') }}">
                @csrf
              <div class="card-header card-header-primary text-center">
                <h4 class="card-title">Login</h4>
              </div>
              <div class="card-body">
                <div>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="material-icons">mail</i>
                    </span>
                  </div>
                  <input type="email" class="form-control" placeholder="Email..."name="email" aria-describedby="emailHelp" value="{{ old('email') }}">
                </div>
                  {!! $errors->first('email','<small class="error">:message</small>') !!}
                </div>
                <div>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="material-icons">lock_outline</i>
                    </span>
                  </div>
                  <input type="password" class="form-control" placeholder="Password..."  name="password">
                </div>
                  {!! $errors->first('password','<small class="error">:message</small>') !!}
                </div>
                <div class="input-group justify-content-center">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <input type="checkbox" class="form-check-input" id="rememberCheck">
                        </span>
                      </div>
                    
                    <label class="form-check-label" name="remember" for="rememberCheck">Mantener la sesion iniciada?</label>
                </div>

              </div>
              <div class="footer text-center">
                <button type="submit" class="btn btn-primary btn-link btn-wd btn-lg">Iniciar Sesión</button>
                <p>¿Aún no tienes cuenta? <a href="{{ route('registro') }}">Registrate</a></p>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    
  </div>
@endsection