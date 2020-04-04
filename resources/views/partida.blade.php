@extends('layouts.master')
@section('content')


<script src="{{ asset('js/main.js') }}"></script>

<div class="container">
    <div class="row">
        <!-- parte 1 -->
        <div class="col" id="parte1">
            <div class="card">
                <div class="card-header" style="background-color: #007bff; border-color: #007bff; color: white;">Partida {{$game->id}}</div>
                <p class="card-body">{{$game->surname_white}},{{$game->name_white}} vs {{$game->surname_black}},{{$game->name_black}} in {{$game->tournament}}</p>
                <p class="card-body"> Resultado: {{$result}}</p>
                <p class="card-body" id="movimientos">{{$game->movements}}</p>
                <p style="visibility: hidden; display: none;" id="movimientos-procesados">{{$game->movements_processed}}</p>
                <!-- jugadas con los listener -->
                <div id="listeners"></div>
            </div>
            
        </div>
        <!-- parte 2 -->
        <div class="col" id="parte2">
            <div class="card">
                <div class="card-header">Tablero</div>
                <div id="myBoard"></div>
                <div class="row" id="div_botones" style="background-color: F6E3DF;"> 
                    <div class="col">
                        <button type="button" id="before" class="btn btn-default" style="background-color: white; margin-top: 5%; width: 100%; border-color: black;">🢘 Anterior</button>
                    </div>
                    <div class="col">
                        <button type="button" id="next" class="btn btn-default" style="background-color: white; margin-top: 5%; width: 100%; border-color: black;">Siguiente 🢚</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>

@endsection