@extends('layouts.master')
@section('title','ChessCloud')
@section('content')
@if (count($errors) > 0)              
    <div class="alert alert-info alert-dismissable">
        <a class="panel-close close" data-dismiss="alert">×</a> 
        <i class="fa fa-coffee"></i>
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
    </div>
@endif
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre jugador blancas</th>                    
                <th>Nombre jugador negras</th>
                <th></th>
                
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
                    
                    .glyphicon-plus 
                    {
                            color:	rgb(0, 255, 0);
                    }
                    
                    .glyphicon-trash 
                    {
                            color: rgb(209, 91, 71);
                    }
                </style>
                
                <tr>
                                          
                        <td>{{$game->id}}</td>
                        <td><input value="{{$game->name_white}}" name="name{{$game->id}}"></td>                                                                                             
                        <td><button onclick="editGame(this)" name="edit" value="{{$game->id}}" type="submit" class="btn btn-link"><span class="glyphicon glyphicon-pencil"></span></button></td>
                        <td><button onclick="borrar(this)" name="delete" value="{{$game->id}}" type="submit" class="btn btn-link"><span class="glyphicon glyphicon-trash"></span></button></td>
                                               
                </tr>
            @endforeach
            <tr>
                    <td></td>   
                                                 
                        <td><input placeholder="Nombre jugador blancas" name="name"></td>                      
                        <td><button onclick="addGame()" type="submit" class="btn btn-link"><span class="glyphicon glyphicon-plus"></span></button></td>                                                              
                </tr>
        </tbody>
    </table>
{{ $games->links() }}
@endsection
