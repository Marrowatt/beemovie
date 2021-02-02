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
            ['Iraí', 'Nannotrigona testaceicornes'],
            ['Jataí', 'Tetragonisca angustula'],
            ['Jataí-da-Terra', 'Paratrigona subnuda'],
            ['Mandaçaia', 'Melipona mandaçaia'],
            ['Manduri', 'Melipona marginata'],
            ['Tubuna', 'Scaptotrigona bipunctata'],
            ['Mirim Droryana', 'Plebeia droryana'],
            ['Mirim-Guaçu', 'Plebeia remota'],
            ['Mirim-Preguiça', 'Friesella schrottkyi'],
            ['Lambe-Olhos', 'Leurotrigona muelleri'],
            ['Borá', 'Tetragona clavipes'],
            ['Boca-de-Sapo', 'Partamona helleri'],
            ['Guira', 'Geotrigona mombuca'],
            ['Marmelada Amarela', 'Frieseomelitta varia'],
            ['Mombucão', 'Cephalotrigona capitata'],
            ['Guiruçu', 'Schwarziana quadripunctata'],
            ['Tatairá', 'Oxytrigona tataira tataira'],
            ['Irapuã', 'Trinona spinipes'],
            ['Abelha-Limão', 'Lestrimelitta limao'],
            ['Bieira', 'Mourella caerulea'] 
        ];
        
		foreach ($bees as $b){
            \App\Bee::create(['common_name' => $b[0], 'scientific_name' => $b[1]]);
        }
    }
}
