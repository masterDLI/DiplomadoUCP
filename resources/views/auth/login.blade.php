<!DOCTYPE html>
<html lang="es">
<head>

    <meta charset="UTF-8">
    <title>Login Ofirtual</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="css/login/estilo_login.css">
    <link rel="icon" href="/imagenes/favicon.png"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.css">
    <style>
        .error{
            color: red;
            font-size: 13px;
        }
    </style>

</head>

<?php
    $nro = rand(1, 10);
 ?>

<body>


<img class="img-fondo" src="<?php echo '/imagenes/fondo.jpg'; ?>" alt="imagen">
    <div class="pagina">

        <div class="zona-login">


            <div class="zona-ingreso">

                <div class="zona-logo">
                    <img class="imagen" src="/imagenes/logo-empresa-login.png" alt="logo-empresa">
                    <div>
                        <span class="nombre-empresa">ENCUESTAS ONLINE</span>
                    </div>
                </div>
                <div>
                    <hr class="linea-division">
                </div>


                    <form class="form-login" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}


                    <div class="linea {{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="zona-label">
                            <label class="form-label" for="usuario">Email</label>
                        </div>
                        <div class="zona-input">
                            <input id="email" type="email" class="form-input" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="error">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>
                    </div>


                    <div class="linea {{ $errors->has('password') ? ' has-error' : '' }}">
                        <div class="zona-label">
                            <label class="form-label" for="">Contraseña</label>
                        </div>
                        <div class="zona-input">
                            <input id="password" type="password" class="form-input" name="password" required>
                             @if ($errors->has('password'))
                                <span class="error">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                     <div class="linea zona-boton-enviar">
                        <input class="form-submit" type="submit" value="ENTRAR">
                    </div>

                    </form>

                  </div>

        </div>

    </div>

@if ($errors->has('password') OR $errors->has('email'))
    <script>
        swal(
          'Error de Autentificación',
          '{{ $errors->first('email') }}',
          'error'
        )
    </script>
@endif
</body>
</html>