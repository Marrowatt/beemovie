<?php

use Illuminate\Database\Seeder;

class BeeSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bees = [
            ['Uruçu', 'Melipona scutellaris'],
            ['Uruçu-Amarela', 'Melipona rufiventris'],
            ['Guapuru', 'Melipona bicolor'],
            ['Iraí', 'Nannotrigona testaceicornes']
        ];
        
		foreach ($bees as $b){
            \App\Bee::create(['common_name' => $b[0], 'scientific_name' => $b[1]]);
        }
    }
}
