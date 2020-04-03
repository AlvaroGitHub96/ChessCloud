@extends('layouts.master')
@section('content')


<script src="{{ asset('js/main.js') }}"></script>

<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header" style="background-color: #007bff; border-color: #007bff; color: white;">Partida {{$game->id}}</div>
                <p class="card-body">{{$game->surname_white}},{{$game->name_white}} vs {{$game->surname_black}},{{$game->name_black}} in {{$game->tournament}}</p>
                <p class="card-body"> Resultado: {{$result}}</p>
                <p class="card-body" id="movimientos">{{$game->movements}}</p>
            </div>
        </div>
        <div class="col">
        <div class="card">
                <div class="card-header">Reproducir partida aquí (interfaz tablero)</div>
                <!-- NUEVO -->
                <div id="myBoard" style="width: 400px"></div>
                <button id="showPositionBtn">Show position in console</button>
            </div>
        </div>
    </div>
    
</div>

@endsection