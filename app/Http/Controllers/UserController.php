<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $table = 'usuario';
    public function devolverFormulario(){return view('/registrar');}
    
    public function username()
    {
        return 'name';
    }

    public function show($name)
    {
        $user = User::findOrFail($name);
        return $user->name;
    }

    public function create(Request $request)
    {
        //password es la variable del laravel y pass podría llamarse de cualquier forma pues es el nombre de la columna de la bd
        $this->validate($request, [
        'name' => 'required',
        'password' => 'required',
        ]);
        
        $usuario = new User();
        $usuario->name = $request->input('name');
        $usuario->pass = bcrypt($request->input('password'));
        $usuario->save();
        //debug($user);
        return view("/home");
    }

    public function entrar(Request $request) {
        return view("/entrar");
    }

    public function iniciado(Request $request) {
        
        try{
            $usuario = User::where('name', '=', $request->input('name'));
        }
        catch (Illuminate\Database\Eloquent\ModelNotFoundException $excepcion){
            return Redirect::back()->withErrors($excepcion->message);
        }
        return view("/home");
        //return Redirect::view('/home');
    }

    public function logOut(){
        Auth::logout();
        //session()->forget("video");
        return view('entrar');
    }
}