<?php

use Illuminate\Database\Seeder;

class MonthSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $months = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto',
                   'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
        
		foreach ($months as $m){
            \App\Month::create(['name' => $m]);
        }
    }
}
