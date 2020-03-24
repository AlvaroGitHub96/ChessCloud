<html lang="es">
    <head>
    <title>@yield('title')</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Icono de la web -->
        <link rel="icon" href="images/peon.jpg">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <!-- mi css propio -->
        <link href="{{ asset('css/site.css') }}" rel="stylesheet">
    </head>

    <body>   
            <nav class="navbar navbar-expand-md navbar-light bg-light sticky-top">
                    <img src="/images/peon2.png" class="navbar-brand"></img>
                    <a class="navbar-brand" href="/home">ChessCloud</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navegacion">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navegacion">
                        <ul class="navbar-nav">
                            @if(Auth::check())
                                <li class="nav-item"><span class="navbar-text">Bienvenido {{Auth::User()->name}}</span></li>
                                <li class="nav-item"><a class="nav-link" href="/modificarUsuario">Perfil</a></li>
                                <li class="nav-item"><a class="nav-link" href="/salir">Cerrar Sesión</a></li>
                                <li class="nav-item"><a class="nav-link" href="/partidas">Partidas</a></li>
                            @else
                                <li class="nav-item"><a class="nav-link" href="/entrar">Entrar</a></li>
                                <li class="nav-item"><a class="nav-link" href="/registrar">Registrarse</a></li>
                                <li class="nav-item"><a class="nav-link" href="/partidas">Partidas</a></li>
                            @endif
                        </ul>
                    </div>
            </nav>

            @yield('content')
        <footer class="fixed-bottom">
            <a style="color: black;">Álvaro Navarro López-Menchero</a>
        </footer>
    </body>
</html>