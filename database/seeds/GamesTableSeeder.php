<?php

use Illuminate\Database\Seeder;

class GamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('games')->delete();
        Schema::table('games', function($table){
            $table->integer('id_white');
            $table->string('name_white');
            $table->string('surname_white');
            $table->integer('ranking_white');
            $table->string('title_white');
            $table->string('country_white');
            //$table->foreign('id_white')->references('id')->on('players')->onDelete('cascade');
            $table->integer('id_black');
            $table->string('name_black');
            $table->string('surname_black');
            $table->integer('ranking_black');
            $table->string('title_black');
            $table->string('country_black');
            //$table->foreign('id_black')->references('id')->on('players')->onDelete('cascade');
            $table->string('tournament');
            $table->integer('result');
            $table->text('movements');
        });
        
        $cantidad_jugadores = DB::table('players')->count();
        //print_r($cantidad_jugadores);
        $TAM = 50;
        for($i = 0;$i < $TAM;$i++){
            $id_blancas = rand(0,$cantidad_jugadores-1);
            $id_negras = rand(0,$cantidad_jugadores-1);
            while($id_blancas === $id_negras){
                 $id_negras = rand(0,$cantidad_jugadores-1);
            }

            $jugador_blancas = DB::table('players')->where('id', $id_blancas)->get()->first();
            $jugador_negras = DB::table('players')->where('id', $id_negras)->get()->first();
            $torneo_aux = $this->randTournament();
            $partida_aux = $this->jugadasPartida();
            DB::table('games')->insert([
                'id_white' => $id_blancas,
                'name_white' => $jugador_blancas->name,
                'surname_white' => $jugador_blancas->surname,
                'ranking_white' => $jugador_blancas->ranking,
                'title_white' => $jugador_blancas->title,
                'country_white' => $jugador_blancas->country,
                'id_black' => $id_negras,
                'name_black' => $jugador_negras->name,
                'surname_black' => $jugador_negras->surname,
                'ranking_black' => $jugador_negras->ranking,
                'title_black' => $jugador_negras->title,
                'country_black' => $jugador_negras->country,
                'tournament' => $torneo_aux,
                'movements' => $partida_aux,
                'result' => rand(0,2)]);//0 white, 1 draw, 2 black
        }

    }

    private function randTournament(){
        $tipo = array('Open', 'Liga', 'Magistral');
        $torneo = array('Barcelona', 'Beijing', 'Moscow', 'Linares', 'Londres');
        $stringaux = $tipo[rand(0,count($tipo)-1)]." ".$torneo[rand(0,count($torneo)-1)];
        return $stringaux;
    }

    private function jugadasPartida(){
        $partidas = array('1.e4 e6 2.b3 d5 3.Ab2 dxe4 4.Cc3 Cd7 5.Cxe4 Cgf6 
        6.Cc3 Ae7 7.g3 0–0 8.Ag2 c6 9.Cge2 Cd5 10.a4 Cxc3
        11.Cxc3 Cf6 12.0–0 Cd5 13.Aa3 Axa3 14.Txa3 Cxc3 15.dxc3 De7 
        16.Ta1 Td8 17.De2 Ad7 18.Tfd1 Ae8 19.Td4 Df6 
        20.Tad1 Txd4 21.Txd4 Td8 22.Dd2 Txd4 23.Dxd4',
        '1.c4 e5 2.Cc3 Cc6 3.Cf3 d6 4.d4 Cxd4 5.Cxd4 exd4 
        6.Dxd4 Df6 7.Dd2 Ae6 8.b3 Dg6 9.Ab2 Cf6 10.Cb5 Ce4 
        11.Df4 0–0–0 12.f3 Cc5 13.Cxa7+ Rb8 14.Cb5 Ae7 15.h4 h6 
        16.Ad4 Ad7 17.0–0–0 Axb5 18.cxb5 Ce6 19.Dg4 Dxg4 
        20.fxg4 Cxd4 21.Txd4 Af6 22.Td5 Tde8 23.Th3 Te4 24.g5 Ae5 
        25.Tf3 hxg5 26.hxg5 Th1');
        
        return $partidas[rand(0,count($partidas)-1)];
    }

}
