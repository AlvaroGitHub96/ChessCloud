<?php

use Illuminate\Database\Seeder;

class PlayersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('players')->delete();
        $TAM = 100;
        for($i = 0;$i < $TAM;$i++){
            $names = $this->randName();
            $surnames = $this->randSurname();
            $pais = $this->randCountry();
            $elo = rand(0,3000);
            $cantidad_titulos = 9;
            $titulo = rand(0,$cantidad_titulos);
            if($elo<1000){$elo=0;}
            DB::table('players')->insert([
                'name' => $names,
                'surname' => $surnames,
                'ranking' => $elo,
                'country' => $pais,
                'id_title' =>$titulo,
                'colour' => rand(0,1)]);//0 white, 1 black
        }

    }
    private function randName(){
        $nombres = array('Pablo', 'Manuel', 'Clara', 'David', 'Alvaro', 'Carlos', 'Francisco', 'Javier', 'Aitor', 'Angel', 'Nerea', 'Carmen', 'Alba', 'Eugenio', 'Albert', 'Flanagan');
        return $nombres;
    }
    private function randSurname(){
        $apellidos = array('Lopez', 'Perez', 'Belmar', 'Navarro', 'Carmona', 'Epifanio', 'Rodes', 'Bolson', 'Tejedor', 'Tevar', 'Garcia', 'Rodriguez', 'Jimenez', 'Galindo');
        return $apellidos;
    }

    private function randCountry(){
        $paises = array('España', 'Francia', 'Portugal', 'Reino Unido', 'Alemania', 'Italia', 'USA', 'Rusia', 'China', 'India', 'Grecia', 'Cuba');
        return $paises;
    }
}
