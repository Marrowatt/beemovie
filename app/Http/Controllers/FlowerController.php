<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Flower;
use Carbon\Carbon;

class FlowerController extends Controller
{
    public function createFlower (Request $request) {

        $this->validate($request, [
            'name' => 'required|string',
            'species' => 'required|string',
            'description' => 'required|string',
            'months_id' => 'required',
            'bees_id' => 'required',
        ]);

        $src = null;

        if($request->hasFile('image')) {

            $src = $request->file('image')->store("flowers/" . Carbon::now()->format('Y-m-d'), 'public');
        }

        $flower = Flower::create([
            'name' => $request->name,
            'species' => $request->species,
            'description' => $request->description,
            'image' => $src
        ]);

        $months = preg_split('/[,]+/', $request->months_id);
        $bees = preg_split('/[,]+/', $request->bees_id);

        foreach($months as $k => $m) {
            $flower->month()->attach($m);
        }

        foreach($bees as $k => $b) {
            $flower->bee()->attach($b);
        }

        return true;
    }

    public function searchFlowers (Request $params) {

        $flowers = [];

        if(empty($params["months_id"]) && empty($params["bees_id"])) {
            
            return Flower::get()->toArray();
        } else {

            $bees = array();
            $months = array();

            if(!empty($params['bees_id'])) {

                foreach($params['bees_id'] as $k => $m) {
    
                    array_push($bees, json_decode($m, true)['id']);
                }

                $flowers = Flower::whereHas('bee', function (Builder $q2) use ($bees) {
                    $q2->whereIn('bee_id', $bees);
                });
            }

            if(!empty($params['months_id'])) {

                foreach($params['months_id'] as $k => $m) {
    
                    array_push($months, json_decode($m, true)['id']);
                }

                $flowers = Flower::whereHas('month', function (Builder $q) use ($months) {
                    $q->whereIn('month_id', $months);
                });
            }
        }

        return $flowers->get()->toArray();
    }
}
