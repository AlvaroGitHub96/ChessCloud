@extends('layouts.master')

@section('content')
<div class="container">
    <div class="form-group">
        <div class="col-md-10 col-md-offset-2">
            <div class="card">
                <h1 style="background-color: #007bff; border-color: #007bff; color: white;" class="card-heading">Registrar partida</h1>
                <div class="card-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ action('GameController@crearPartida') }}">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col">
                                <input id="nombre_blancas" type="text" class="form-control" name="nombre_blancas" placeholder="nombre jugador blancas" required autofocus>
                            </div>
                            <div class="col">
                                <input id="apellido_blancas" type="text" class="form-control" name="apellido_blancas" placeholder="apellido jugador blancas" required autofocus>
                            </div>
                        </div>
                        <br></br>
                        <div class="row">
                            <div class="col">
                                <input id="nombre_negras" type="text" class="form-control" name="nombre_negras" placeholder="nombre jugador negras" required autofocus>
                            </div>
                            <div class="col">
                                <input id="apellido_negras" type="text" class="form-control" name="apellido_negras" placeholder="apellido jugador negras" required autofocus>
                            </div>
                        </div>
                        <br></br>
                        <div class="row">
                            <div class="col">
                                <input id="Elo_blancas" type="text" class="form-control" name="Elo_blancas" placeholder="Elo jugador blancas" required autofocus>
                            </div>
                            <div class="col">
                                <input id="Elo_negras" type="text" class="form-control" name="Elo_negras" placeholder="Elo jugador negras" required autofocus>
                            </div>
                        </div>
                        <br></br>
                        <div class="row">
                            <div class="col">
                                <input id="torneo" type="text" class="form-control" name="torneo" placeholder="torneo" required autofocus>
                            </div>
                            <div class="col">
                                <div>
                                    <select class="form-control" name="resultado" id="resultado">
                                        <option value="blancas">1 - 0</option>
                                        <option value="tablas">1/2 - 1/2</option>
                                        <option value="negras">0 - 1</option>
                                    </select>
                                </div>                          
                             </div>
                        </div>
                        <br></br>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Registrar partida
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
