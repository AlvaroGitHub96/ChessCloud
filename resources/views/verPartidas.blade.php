@extends('layouts.master')
@section('content')



<div class="container">
    <div class="row">
        <div class="card" style="background-color: #F6E3DF; border: none;">
            <h1>Lista de partidas</h1>
        </div>
    </div>
    <br></br>
    <div class="row">
        @foreach ($games as $g)
        <div class="card">
            <div class="card-header" style="background-color: #007bff; border-color: #007bff; color: white;">Partida {{$g->id}}</div>
            <div class="card-body">
                <h4 class="card-title"> {{$g->surname_white}},{{$g->name_white}} vs {{$g->surname_black}},{{$g->name_black}} in {{$g->tournament}} </h4>            
                <p class="card-text">{{$g->movements}}</p>
                <a href="/partida/{{$g->id}}" class="btn btn-primary">Ver Partida</a>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection