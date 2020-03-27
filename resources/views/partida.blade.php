@extends('layouts.master')
@section('content')


<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">Partida {{$game->id}}</div>
                <div class="card-body">Datos</div>
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