<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bee;

class BeeController extends Controller
{
    public function getBees () {

        $bees = Bee::select('common_name', 'id')->get();

        return $bees->toArray();
    }

    public function createBee (Request $request) {

        $this->validate($request, [
            'common_name' => 'required|string',
            'scientific_name' => 'required|string'
        ]);

        Bee::create([
            'common_name' => $request->common_name,
            'scientific_name' => $request->scientific_name
        ]);

        return true;
    }
}
