<?php

use Illuminate\Database\Seeder;

class MovementsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('movements')->delete();
        $partidas = DB::table('games')->get();
        $cantidad_partidas = mysql_num_rows();
        $id_partida = rand(0,$cantidad_partidas-1);
        $jugadas = [['e4', 'e5'], ['Ac4', 'Cc6'], ['Dh5', 'Cf6'], ['Dxf7++']];
        $blancas = true;
        $TAM = 0;
        for($k=0;$k<$jugadas.length;$k++){
        	$TAM+=$jugadas[k].length;
        }
        for($i = 0;$i < $cantidad_partidas;$i++){
            for($j = 0; $j<$TAM; $j++){
            	DB::table('movements')->insert([
                'id_game' => $id_blancas,
                'id_black' => $id_negras,
                'movement' => 'e4',
                'id_matter' => 0,
                'comment' = '']);
            }
            
        }

    }

}
