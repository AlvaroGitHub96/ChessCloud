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
        $cantidad_jugadores = mysql_num_rows(DB::table('players')->get());
        $TAM = 50;
        $id_blancas = rand(0,$cantidad_jugadores-1);
        $id_negras = rand(0,$cantidad_jugadores-1);
        while($id_blancas === $id_negras){
             $id_negras = rand(0,$cantidad_jugadores-1);
        }
        for($i = 0;$i < $TAM;$i++){
            DB::table('games')->insert([
                'id_white' => $id_blancas,
                'id_black' => $id_negras,
                'tournament' => randTournament(),
                'result' => rand(0,2)]);//0 white, 1 draw, 2 black
        }

    }

    private function randTournament(){
        $tipo = array('Open', 'Liga', 'Magistral');
        $torneo = array('Barcelona', 'Beijing', 'Moscow');
        $stringaux = $tipo[rand(0,count($tipo)-1)]." ".$torneo[rand(0,count($apellidos)-1)]." ".$torneo[rand(0,count($torneo)-1)];
        return $stringaux;
    }
}
