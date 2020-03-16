<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //protected $table = 'usuario';
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
    //para el registro
    public function create(Request $request)
    {
        //password es la variable del laravel y pass podría llamarse de cualquier forma pues es el nombre de la columna de la bd
        $this->validate($request, [
        'email' => 'required',  
        'name' => 'required',
        'password' => 'required',
        ]);
        
        $usuario = new User();
        $usuario->email = $request->input('email');
        $usuario->name = $request->input('name');
        $usuario->password = $request->input('password');
        $usuario->save();
        //$usuario = User::create($request(['name', 'email', 'password']));
        
        auth()->login($usuario);
        //debug($user);
        return redirect("/home");
    }

    public function entrar(Request $request) {
        return view("/entrar");
    }
    //para el login
    public function iniciado(Request $request) {
        //echo 'entra a logearse';
        try{
            $credenciales = $request->only('email','name','password');
            if(Auth::attempt($credenciales)){
                return redirect("/home");
            }
            else{
                return redirect("/home")->withErrors('Error al iniciar sesión');
            }
            //$nombre = $request->input('name');
            //$pass = $request->input('password');
            //$usuario = User::where('name', '=', $nombre, 'and', 'pass', '=',  $pass)->first();
        }
        catch (Illuminate\Database\Eloquent\ModelNotFoundException $excepcion){
            return Redirect::back()->withErrors($excepcion->message);
        }
        return redirect("/home");
        //return Redirect::view('/home');
    }

    public function logOut(){
        Auth::logout();
        return redirect('entrar');
    }
    //modificar
    //get
    public function modificarDatos(){
        return view("modificarUsuario");//('modificarUsuario');
    }
    //post
    public function update(Request $request)
    {
        $user = User::where('id', 'like', '%'.Auth::user()->id.'%')->first();        
        if ($user->email == $request->input('email'))
        {
            $this->validate($request, [
            'name' => 'required|regex:/^[a-zA-Z]+$/u|max:20',
            'email' => 'required|email',
            'password' => 'required',
            ]);
        }
        else
        {
            $this->validate($request, [
            'name' => 'required|regex:/^[a-zA-Z]+$/u|max:20',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            ]);
        }
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if ($user->password != $request->input('password'))
            $user->password = bcrypt($request->input('password'));
        //$user->creditcard = $request->input('creditCard');
        $user->save();
        return view("/home");        
    }
}