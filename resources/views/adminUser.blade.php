@extends('layouts.master')
@section('title','ChessCloud')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="{{ asset('js/adminUser.js') }}"></script>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Nombre</th>
            <th>Password</th>
            <th>Rol</th>
            
        </tr>
    </thead>
    <tbody>
        @foreach ($usuarios as $usuario)
            <style>
                input
                {
                    background-color: transparent;
                    border: 0px;
                    
                }
            </style>
            <tr>
                    <td><input value="{{$usuario->id}}" readonly></input></td>                                
                    <td><input value="{{$usuario->email}}" name="email{{$usuario->id}}" style="width: 100%;"></td>
                    <td><input value="{{$usuario->name}}" name="name{{$usuario->id}}" style="width: 100%;"></td>
                    <td><input value="{{$usuario->password}}" name="password{{$usuario->id}}" style="width: 100%;"></td>
                    <td>
                        <input  value="{{$usuario->rol_id}}" name="rol{{$usuario->id}}">
                        <a onclick="edit(this)" id="edit" name="edit" value="{{$usuario->id}}" class="btn btn-link"> &#x270e; </a>
                    </td>
                    <td><a onclick="borrar(this)" id="delete" name="delete" value="{{$usuario->id}}" type="submit" class="btn btn-danger"> x </a></td>

            </tr>
        @endforeach
        <form id="aux_form" class="form-horizontal" role="form" action="{{ action('UserController@execAdmin') }}" method="POST">
          {{ csrf_field() }}
            <tr>        
                        <td></td>
                        <td><input placeholder="Email" name="email" required></td>
                        <td><input placeholder="Nombre" name="name" required></td>    
                        <td><input placeholder="Password" name="password" required></td>
                        <td><label>0</label></td>                        
                        <td><button onclick="insert(this)" id="add" type="submit" class="btn btn-success"> + </button></td>
            </tr>
        </form>
    </tbody>
</table>

<form id="form" class="form-horizontal invisible" role="form" action="{{ action('UserController@execAdmin') }}" method="POST">

        <input id="id" name="id" type="text"></input>
        <input id="email" name="email" type="text"></input>
        <input id="name" name="name" type="text"></input>
        <input id="pass" name="pass" type="text"></input>
        <input id="rol" name="rol" type="text"></input>
        <input id="type"  name="type"></input>
        {{ csrf_field() }}
</form>

{{ $usuarios->links() }}
@endsection