<html>
    <head>
       <!--  <link id="common-css" rel="stylesheet" type="text/css" href="/style.css"> -->
        <!-- 
            ../ -> views
            ../ -> resources
            ../ -> 
            -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <link rel="shortcut icon" href="{{{ asset('logos/logopng.png') }}}">
        <title>@yield('title')</title>
        <!--<link rel="stylesheet" type="text/css" href="site.css">-->
        <link href="{{ asset('css/site.css') }}" rel="stylesheet">
        <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
        <!--<script src="//code.jquery.com/jquery-1.12.4.min.js"></script>-->
        <script src="//releases.flowplayer.org/7.0.2/flowplayer.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <!--<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">-->
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    </head>

    <body>
        <main>
            @if(Auth::check())
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                    <a class="navbar-brand" href="/home">ChessCloud</a>
                    </div>
                    <ul class="nav navbar-nav">
                    <li><span class="navbar-text">Bienvenido {{Auth::User()->name}}</span></li>
                    <li><a href="/modificarUsuario">Perfil</a></li>
                    <li><a href="/salir">Cerrar Sesión</a></li>
                    </ul>
                </div>
            </nav>
            @else
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="/home">ChessCloud</a>
                    </div>
                    <ul class="nav navbar-nav">
                    <!--<li class="active"><a href="#">Home</a></li>-->
                    <li><a href="/entrar">Entrar</a></li>
                    <li><a href="/registrar">Registrarse</a></li>
                    <li><a href="/partidas">Partidas</a></li>
                    </ul>
                </div>
            </nav>
            @endif

            @yield('content')
        </main>
        <footer class="fixed-bottom">
            <a>Álvaro Navarro López-Menchero</a>
        </footer>
    </body>
</html>