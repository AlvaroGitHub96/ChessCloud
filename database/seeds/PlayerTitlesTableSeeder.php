<?php

use Illuminate\Database\Seeder;

class RolUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Recupera todos los objetos de la tabla
        $players = DB::table('players')->get();
        // $users es de tipo Illuminate\Support\Collection
        foreach ($players as $player) {
            if($player->id != 1){
            // Los objetos son de tipo StdClass
            // y se puede acceder a sus propiedades
            /*for recorra 3 veces
                premion&&gratis NO
                guardar en un auxiliar */ 
                $auxiliar;
                $cantidad_titulos = 9;
                for($i=0;$i<$cantidad_roles;$i++){
                    if($i==0){
                        $auxiliar=rand(1,2);
                        $i++;
                        DB::table('player_titles')->insert([
                        'player_id' => $user->id,
                        'title_id' => $auxiliar]);
                    }
                    else{
                        if(rand(0,99)==0){
                            DB::table('player_titles')->insert([
                            'player_id' => $user->id,
                            'title_id' => $i+1]);
                        }   
                    }
                    
                }
            }
            else
            {
                DB::table('player_titles')->insert([
                        'player_id' => 1,
                        'title_id' => 4]);
            }  
        }

            

        // Recupera un único objeto
        $player = DB::table('players')->where('name', 'Magnus')->first();
    }
}
