@extends('layouts.master')
@section('content')

<script type="text/javascript" src="js/bootstrap-multiselect.js"></script>
<link rel="stylesheet" href="css/bootstrap-multiselect.css" type="text/css"/>

<!-- boton -->

<div class="row">
    <div class="col-md-12">
        <div class="btn-group">
            <form action="{{ action('GameController@verPartidas') }}" method="GET">
                {{ csrf_field() }}
                <select id="ordenado" name="orden[]" multiple="multiple" class="btn btn-info">
                    <optgroup label="Tipo">
                        <option value="alf" selected="selected">Alfabeticamente</option>
                        <option value="cro">Cronologicamente</option>
                    </optgroup>
                    <optgroup label="Asc/Desc">
                        <option value="asc" selected="selected">Ascendente</option>
                        <option value="des">Descendente</option>
                    </optgroup>
                </select>
                <button type="submit" class="btn btn-warning">Filtrar</button>
            </form>
        </div>
    </div>
</div>

<h2 align="center">Partidas</h2>
 
<!-- lista de las partidas -->

<div>
    <ul class="list-group">
    @foreach ($games as $g)
        <li class="list-group-item">
            <img src="images/tablero.jpg" title="{{$g->id}}" alt="{{$g->id}}" />
            <div class="thumbnail">
                    <a clas="btn btn-info" href="/partida/{{$g->id}}">
                        Partida {{$g->id}}
                    </a>
                    <div class="caption">
                        <h4>
                            {{$g->movements}}
                        </h4>
                    </div>
                    </a>
             </div>
        </li>
    @endforeach
    </ul>
</div>


@endsection