<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class GameController extends Controller
{

    public function practicar(){
        return view("/practicar");
    }
    public function crearPartida(Request $request)
    {
        //password es la variable del laravel y pass podría llamarse de cualquier forma pues es el nombre de la columna de la bd
        /*$this->validate($request, [
        'email' => 'required',  
        'name' => 'required',
        'password' => 'required',
        ]);*/
        
        $game = new Game();
        $game->name_white = $request->input('nombre_blancas');
        $game->surname_white = $request->input('apellido_blancas');
        $game->ranking_white = $request->input('Elo_blancas');
        $game->name_black = $request->input('nombre_negras');
        $game->surname_black = $request->input('apellido_negras');
        $game->ranking_black = $request->input('Elo_negras');
        //$usuario->email_verified = 1;
        $usuario->save();
        //$usuario = User::create($request(['name', 'email', 'password']));
        
        //debug($user);
        return redirect("/verPartidas");
    }

    public function devolverFormularioPartida(){return view('/registrarPartida');}

    public function buscar(Request $request){
        $nombre = $request->input('nombre');
        $torneo = $request->input('torneo');
        $ranking = $request->input('ranking');
        $jugador = $request->input("jugador_buscar");
        $games = DB::table('games');
        //->paginate(6);
        //para paginar, revisar más arriba  
        if($nombre!=""){
            $games = $games->where(function($q) use ($nombre){
                $q->where('name_white', 'like', '%'.$nombre.'%')
                ->orWhere('surname_white', 'like', '%'.$nombre.'%')
                ->orWhere('name_black', 'like', '%'.$nombre.'%')
                ->orWhere('surname_black', 'like', '%'.$nombre.'%');
            });
        }
        if($torneo!=""){
            $games = $games->where('tournament', 'like', '%'.$torneo.'%');
        }
        if($ranking!=""){
            if($jugador=="Jugador blancas"){
                $games = $games->where('ranking_white', '>=', $ranking);
            }
            else if($jugador=="Jugador blancas"){
                $games = $games->where('ranking_black', '>=', $ranking);
            }
            else{
                //ambos
                $games = $games->where(function($elo) use ($ranking){
                    $elo->where('ranking_white', '>=', $ranking)
                    ->orWhere('ranking_black', '>=', $ranking);
                });
            }
        }
        //echo $games->dd();
        $games = $games->get();
        return view('verPartidas')->with('games',$games);
    }

    public function partida($partida){
        $game = DB::table('games')->where('id', '=', $partida)->first();

        $result = $this->obtenerResultado($game->result);
        $Elo_blancas = $this->obtenerEloBlancas($game->ranking_white);
        $Elo_negras = $this->obtenerEloNegras($game->ranking_black);
        

        return view('partida')->with('game',$game)->with('result',$result)->with('Elo_blancas',$Elo_blancas)->with('Elo_negras',$Elo_negras);
    }

    public function obtenerResultado($r) {
        if($r==0){
            return "1 - 0";
        }
        else{
            if($r==1){
                return "1/2 - 1/2";
            }
            else{
                //r==2
                return "0 - 1";
            }
        }
    }

    public function obtenerEloBlancas($ranking_white){
        if($ranking_white==0){
            return "";
        }
        else{
            return $ranking_white;
        }
    }

    public function obtenerEloNegras($ranking_black){
        if($ranking_black==0){
            return "";
        }
        else{
            return $ranking_black;
        }
    }


    public function verPartidas(){
        
        //muestro las partidas de la bd
        $games = DB::table('games')->get();
        //->simplePaginate(10);
        //$filas = DB::table('games')->count();
        //print($filas);

        //$games= App\Game::all();

        return view('verPartidas')->with('games',$games);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
