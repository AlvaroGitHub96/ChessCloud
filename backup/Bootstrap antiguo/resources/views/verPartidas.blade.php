@extends('layouts.master')
@section('content')

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


<div class="div">
    <h1>Partidas</h1>
    @foreach ($games as $g)
    <div class="card" style="width:80%">
        <div class="card-header">{{$g->surname_white}},{{$g->name_white}} vs {{$g->surname_black}},{{$g->name_black}} in {{$g->tournament}}</div>
        <div class="card-body">
            <h4 class="card-title"> Partida {{$g->id}} </h4>            
            <p class="card-text">{{$g->movements}}</p>
            <a href="/partida/{{$g->id}}" class="btn btn-primary stretched-link">Ver Partida</a>
        </div>
    </div>
    @endforeach
</div>

@endsection