<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class GameController extends Controller
{
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
