@extends('layouts.master')
@section('title','ChessCloud')
@section('head')
<script type="text/javascript" src="js/bootstrap-multiselect.js"></script>
<link rel="stylesheet" href="css/bootstrap-multiselect.css" type="text/css"/>


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
<h2>Partidas</h2>
 
<div class="row">
@foreach ($games as $g)
    <div class="col-md-4 col-lg-3">
        <div class="thumbnail">
            <a href="/partida/{{$g->id}}" class="enlace btn" data-togle="tooltip" data-placement="bottom" title="{{$g->id}}">
                <div class="caption">
                    <h4 align="center">
                        {{$g->movements}}
                    </h4>
                </div>
            </a>
        </div>
    </div>
@endforeach
</div>

{{-- <!--<ul class="pager">
    {{ $partidas->links() }}
</ul>--> --}}

@endsection