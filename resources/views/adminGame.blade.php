@extends('layouts.master')
@section('title','ChessCloud')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="{{ asset('js/adminGame.js') }}"></script>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre, apelliido y ranking blancas</th>
            <th>Nombre, apellido y ranking negras</th>
            <th>Torneo</th>
            <th>Resultado</th>
            <th>Movimientos</th>
            
        </tr>
    </thead>
    <tbody>
        @foreach ($games as $game)
            <style>
                input
                {
                    background-color: transparent;
                    border: 0px;
                    
                }
            </style>
            <tr>
                    <td><input value="{{$game->id}}" readonly></td>                          
                    <td>
                        <input value="{{$game->name_white}}" style="width: 100%;">
                        <input value="{{$game->surname_white}}" style="width: 100%;">
                        <input value="{{$game->ranking_white}}" style="width: 100%;">
                    </td>
                    <td>
                        <input value="{{$game->name_black}}" style="width: 100%;">
                        <input value="{{$game->surname_black}}" style="width: 100%;">
                        <input value="{{$game->ranking_black}}" style="width: 100%;">
                    </td>
                    <td><input value="{{$game->tournament}}" style="width: 100%;"></td>
                    <td>
                        <select class="form-control" name="resultado">
                            <option value="0" @if ($game->result == 0) selected @endif>1 - 0</option>
                            <option value="1" @if ($game->result == 1) selected @endif>1/2 - 1/2</option>
                            <option value="2" @if ($game->result == 2) selected @endif>0 - 1</option>
                        </select>
                    </td>
                    <td><input value="{{$game->movements}}" readonly></input></td>  
                    <td>
                        <a onclick="edit(this)" id="edit" name="edit" value="{{$game->id}}" class="btn btn-link"> &#x270e; </a>
                        <a onclick="borrar(this)" id="delete" name="delete" value="{{$game->id}}" class="btn btn-danger"> x </a>
                    </td>
                    

            </tr>
        @endforeach

        <tr>        
                <td></td>
                <td>
                    <input placeholder="name white">
                    <input placeholder="surname white">
                    <input placeholder="ranking white" style="width: 100%;">
                </td>
                <td>
                    <input placeholder="name black">
                    <input placeholder="surname black">
                    <input placeholder="ranking black">
                </td>
                <td><input placeholder="tournament"></td>
                <td>
                    <select class="form-control" name="resultado">
                        <option value="0">1 - 0</option>
                        <option value="1">1/2 - 1/2</option>
                        <option value="2">0 - 1</option>
                    </select>
                </td>
                <td>
                    <input placeholder="movements"></input>
                    <label>Ejemplo: 1.e4 e5 2.Nf3</label>
                </td>  
                <td>
                    <button onclick="insert(this)" type="submit" id="add" class="btn btn-success"> + </button>
                </td>
        </tr>

    </tbody>
</table>

<form id="form" class="form-horizontal invisible" role="form" action="{{ action('GameController@execAdmin') }}" method="POST">

        <input id="id" name="id" type="text"></input>
        <input id="name_white" name="name_white" type="text"></input>
        <input id="surname_white" name="surname_white" type="text"></input>
        <input id="ranking_white" name="ranking_white" type="text"></input>
        <input id="name_black" name="name_black" type="text"></input>
        <input id="surname_black" name="surname_black" type="text"></input>
        <input id="ranking_black" name="ranking_black" type="text"></input>
        <input id="tournament" name="tournament" type="text"></input>
        <input id="movements" name="movements" type="text"></input>
        <input id="result" name="result" type="text"></input>
        <input id="type"  name="type"></input>
        {{ csrf_field() }}
</form>

{{ $games->links() }}
@endsection