<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Game;

class GameController extends Controller
{

    public function practicar(){
        return view("/practicar");
    }
    public function crearPartida(Request $request)
    {
        //dd($request->all());
        if($request->input("resultado")=="blancas"){
            $result = 0;
        }
        else if($request->input("resultado")=="negras"){
            $result = 2;
        }
        else{
            $result = 1;
        }
        if($request->input('titulo_blancas')=="Ninguno"){
            $titulo_blancas = " "; 
        }
        else{
            $titulo_blancas = $request->input('titulo_blancas');
        }

        if($request->input('titulo_negras')=="Ninguno"){
            $titulo_negras = " "; 
        }
        else{
            $titulo_negras = $request->input('titulo_negras');
        }
        //consulto si el jugador esta en players
        //si lo está cojo su id
        //si no lo está le asigno uno nuevo
        //Otra opcion: id 9999 para los no registrados y que luego el administrador se encargue
        //luego lo guardo
        //AÑADIR IF PARA QUE TENGA MOVIMIENTOS LA PARTIDA
        $movimientos = $request->input('mov');
        /*if($movimientos==""){
            return redirect()->back() ->with('alert', 'No hay jugadas!');
        }*/
        $game = new Game();
        ////////
        $game->id_white = 9999;
        $game->id_black = 9999;
        ////////

        $game->title_white = $titulo_blancas;
        $game->title_black = $titulo_negras;
        $game->country_white = $request->input('pais_blancas');
        $game->country_black = $request->input('pais_negras');
        $game->name_white = $request->input('nombre_blancas');
        $game->surname_white = $request->input('apellido_blancas');
        $game->ranking_white = $request->input('Elo_blancas');
        $game->name_black = $request->input('nombre_negras');
        $game->surname_black = $request->input('apellido_negras');
        $game->ranking_black = $request->input('Elo_negras');
        $game->movements = $movimientos;
        $game->result = $result;
        $game->tournament = $request->input("torneo");
        $game->movements_processed = $this->ConvierteMovimientos($movimientos);
        //$game->game_verified = 1;
        $game->save();
        
        //$usuario = User::create($request(['name', 'email', 'password']));
        
        //debug($user);
        return view("/partidas")->paginate(10);
    }

    public function ConvierteMovimientos($movimientos){
        //1. e4 e6 2. d4 d5
        //e4 d5,d4 d5
        $movimientos_array = explode(" ", $movimientos);
        $tam = sizeOf($movimientos_array);
        $movimientos_processed = "";
        for($i = 1; $i<$tam;$i+=3){
            $first = $movimientos_array[$i++];
            $second = ($i<$tam-1) ? ($movimientos_array[$i].",") : "";
            $movimientos_processed .= $first." ".$second;
        }
        return $movimientos_processed;
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
        $games = $games->paginate(10);
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
        $games = DB::table('games')->paginate(10);
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
