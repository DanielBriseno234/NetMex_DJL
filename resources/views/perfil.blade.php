@extends('plantillas/plantillaGral')

@section('estilos')
    <!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
                        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
                        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
    <link rel="stylesheet" href="css/perfil.css">
@endsection


@section('contenido')
    <div class="container emp-profile">
        <div class="row">
            <div class="col-md-4">
                <div class="profile-img">
                    <form action="{{ route('cambiar-imagen') }}" name="formulario" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <img src="{{ Auth::user()->imagen }}" alt="" />
                        <div class="file btn btn-lg btn-file">
                            Change Photo
                            <input type="file" name="imagen" />
                            <span id="error"></span>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-8 text-dark">
                <div class="profile-head">
                    <div id="donate-button-container" class="border rounded p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h5>Para nosotros es importante seguir creciendo</h5>
                                <p style="margin: 0">Por ello te agradeceriamos cualquier donación para seguir avanzando</p>
                            </div>
                            <div id="donate-button"></div>
                        </div>
                        <script src="https://www.paypalobjects.com/donate/sdk/donate-sdk.js" charset="UTF-8"></script>
                        <script>
                            PayPal.Donation.Button({
                                env: 'production',
                                hosted_button_id: 'E9QR8JY3VZUC4',
                                image: {
                                    src: 'https://www.paypalobjects.com/es_XC/i/btn/btn_donate_LG.gif',
                                    alt: 'Donar con el botón PayPal',
                                    title: 'PayPal - The safer, easier way to pay online!',
                                }
                            }).render('#donate-button');
                        </script>

                    </div>


                    <h5 class="mt-3">
                        {{ Auth::user()->nombre }} {{ Auth::user()->apPaterno }} {{ Auth::user()->apMaterno }}
                    </h5>
                    <h6>
                        Usuario de la plataforma NetMex
                    </h6>
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active text-dark" id="nav-home-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                                aria-selected="true">Datos</button>
                            <button class="nav-link text-dark" id="nav-profile-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile"
                                aria-selected="false">Modificar información</button>
                            <button class="nav-link text-dark" id="nav-contact-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact"
                                aria-selected="false">Cambiar Contraseña</button>
                        </div>
                    </nav>

                </div>

                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="row">
                            <div class="col-md-4 fw-bold">
                                <label>Id</label>
                            </div>
                            <div class="col-md-8">
                                <p>{{ Auth::user()->id }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 fw-bold">
                                <label>Nombre</label>
                            </div>
                            <div class="col-md-8">
                                <p>{{ Auth::user()->nombre }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 fw-bold">
                                <label>Apellido Paterno</label>
                            </div>
                            <div class="col-md-8">
                                <p>{{ Auth::user()->apPaterno }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 fw-bold">
                                <label>Apelido Materno</label>
                            </div>
                            <div class="col-md-8">
                                <p>{{ Auth::user()->apMaterno }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 fw-bold">
                                <label>Email</label>
                            </div>
                            <div class="col-md-8">
                                <p>{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 fw-bold">
                                <label>Username</label>
                            </div>
                            <div class="col-md-8">
                                <p>{{ Auth::user()->username }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <form method="POST" action="{{ route('modificar-datos') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-3 fw-bold">
                                    <label>Nombre</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="Nombre..." id="nombre"
                                        name="nombre" aria-describedby="emailHelp" value="{{ Auth::user()->nombre }}">
                                    {!! $errors->first('nombre', '<small class="error">:message</small>') !!}
                                </div>
                            </div>
                            <div class="row pt-1">
                                <div class="col-md-3 fw-bold">
                                    <label>Apellido Paterno</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="Apellido Paterno..."
                                        id="apPaterno" name="apPaterno" aria-describedby="emailHelp"
                                        value="{{ Auth::user()->apPaterno }}">
                                    {!! $errors->first('apPaterno', '<small class="error">:message</small>') !!}
                                </div>
                            </div>
                            <div class="row pt-1">
                                <div class="col-md-3 fw-bold">
                                    <label>Apellido Materno</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="apMaterno"
                                        placeholder="Apellido Materno..." name="apMaterno" aria-describedby="emailHelp"
                                        value="{{ Auth::user()->apMaterno }}">
                                    {!! $errors->first('apMaterno', '<small class="error">:message</small>') !!}
                                </div>
                            </div>
                            <div class="row pt-1">
                                <div class="col-md-3 fw-bold">
                                    <label>Email</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="email" class="form-control" placeholder="Email..." name="email"
                                        aria-describedby="emailHelp" value="{{ Auth::user()->email }}">

                                    {!! $errors->first('email', '<small class="error">:message</small>') !!}
                                </div>

                            </div>
                            <div class="row pt-1">
                                <div class="col-md-3 fw-bold">
                                    <label>Username</label><br />
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="username" placeholder="Username..."
                                        name="username" aria-describedby="emailHelp"
                                        value="{{ Auth::user()->username }}">
                                    {!! $errors->first('username', '<small class="error">:message</small>') !!}
                                </div>
                            </div>
                            <div class="footer text-center">
                                <button type="submit" class="profile-edit-btn mt-2">Modificar</button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <form method="POST" action="{{ route('cambiar-contrasena') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-3 fw-bold">
                                    <label>Contraseña actual</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="password" class="form-control" name="passActual"
                                        placeholder="Contraseña Actual..." id="passActual">
                                    {!! $errors->first('passActual', '<small class="error">:message</small>') !!}
                                </div>

                            </div>
                            <div class="row pt-1">
                                <div class="col-md-3 fw-bold">
                                    <label>Nueva Contraseña</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="password" class="form-control" name="passNueva"
                                        placeholder="Nueva Contraseña..." id="passNueva">
                                    {!! $errors->first('passNueva', '<small class="error">:message</small>') !!}
                                </div>
                            </div>
                            <div class="row pt-1">
                                <div class="col-md-3 fw-bold">
                                    <label>Confirmar contraseña</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="password" class="form-control" placeholder="Confirmar Contraseña..."
                                        id="passConfirmar" name="passConfirmar">
                                    {!! $errors->first('passConfirmar', '<small class="error">:message</small>') !!}
                                </div>
                            </div>
                            <div class="footer text-center">
                                <button type="submit" class="profile-edit-btn mt-2">Modificar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'No se pudo realizar la modificación. Por favor revisa que toda la información este completa y vuelve a intentarlo.',
            })
        </script>
    @endif
@endsection

@section('javascript')
    <script src="js/envioForm.js"></script>
@endsection
