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
        $users = DB::table('users')->get();
        // $users es de tipo Illuminate\Support\Collection
        foreach ($users as $user) {
            if($user->id != 1){
            // Los objetos son de tipo StdClass
            // y se puede acceder a sus propiedades
            /*for recorra 3 veces
                premion&&gratis NO
                guardar en un auxiliar */ 
                $auxiliar;
                $cantidad_roles = 3;
                for($i=0;$i<$cantidad_roles;$i++){
                    if($i==0){
                        $auxiliar=rand(1,2);
                        $i++;
                        DB::table('rol_users')->insert([
                        'user_id' => $user->id,
                        'rol_id' => $auxiliar]);
                    }
                    else{
                        if(rand(0,99)==0){
                            DB::table('rol_users')->insert([
                            'user_id' => $user->id,
                            'rol_id' => $i+1]);
                        }   
                    }
                    
                }
            }
            else
            {
                DB::table('rol_users')->insert([
                        'user_id' => 1,
                        'rol_id' => 4]);
            }  
        }

            

        // Recupera un único objeto
        $user = DB::table('users')->where('name', 'John')->first();
    }
}
