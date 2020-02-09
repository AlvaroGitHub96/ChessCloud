<?php

use Illuminate\Database\Seeder;

class TitlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('titles')->insert([
            'titles' => '']);//no titulado
        DB::table('titles')->insert([
            'titles' => 'CM']);
        DB::table('titles')->insert([
            'titles' => 'WCM']);
        DB::table('titles')->insert([
            'titles' => 'FM']);
        DB::table('titles')->insert([
            'titles' => 'WFM']);
        DB::table('titles')->insert([
            'titles' => 'IM']);
        DB::table('titles')->insert([
            'titles' => 'WIM']);
        DB::table('titles')->insert([
            'titles' => 'GM']);
        DB::table('titles')->insert([
            'titles' => 'WGM']);
    }
}
