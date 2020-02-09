<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        $passAdmin = bcrypt("a_1234_z");
        DB::table('users')->insert([
                'name' => "serverslayer",
                'email' => "alvaronavarrolopez@hotmail.com",
                'password' => $passAdmin,
                'email_verified' => 1]);
        for($i = 0;$i < 100;$i++){
            $strings = $this->randString();
            DB::table('users')->insert([
                'name' => $strings,
                'email' => $this->randemail($strings,$i),
                'password' => bcrypt('hola'),
                'email_verified' => rand(0,1)]);//1 true, 0 false
        }

    }
    private function randString(){
        $nombres = array('Pablo', 'Manuel', 'Clara', 'David', 'Alvaro', 'Carlos', 'Francisco', 'Javier', 'Aitor', 'Angel', 'Nerea', 'Carmen', 'Alba', 'Eugenio', 'Albert', 'Flanagan');
        $apellidos = array('Lopez', 'Perez', 'Belmar', 'Navarro', 'Carmona', 'Epifanio', 'Rodes', 'Bolson', 'Tejedor', 'Tevar', 'Garcia', 'Rodriguez', 'Jimenez', 'Galindo');
        $stringaux = $nombres[rand(0,count($nombres)-1)]." ".$apellidos[rand(0,count($apellidos)-1)]." ".$apellidos[rand(0,count($apellidos)-1)];
        return $stringaux;
    }
    private function randemail($nombre, $i){
        $elarray = preg_split('/[\s,]+/',$nombre);
        $elnombre=$elarray[0].$elarray[1].$elarray[2].$i."@raspeig.es";
        return $elnombre;
    }
}
