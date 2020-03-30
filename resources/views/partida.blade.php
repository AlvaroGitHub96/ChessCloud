@extends('layouts.master')
@section('content')


<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header" style="background-color: #007bff; border-color: #007bff; color: white;">Partida {{$game->id}}</div>
                <p class="card-body">{{$game->surname_white}},{{$game->name_white}} vs {{$game->surname_black}},{{$game->name_black}} in {{$game->tournament}}</p>
                <p class="card-body"> resultado: {{$result}}</p>
                <p class="card-body">{{$game->movements}}</p>
            </div>
        </div>
        <div class="col">
        <div class="card">
                <div class="card-header">Reproducir partida aquí (interfaz tablero)</div>
            </div>
        </div>
    </div>
    
</div>

@endsection