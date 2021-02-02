<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flower extends Model
{
    protected $fillable = ['name', 'species', 'description', 'image'];
    
    public function month () {
        return $this->belongsToMany(Month::class, 'flowers_months');
    }
    
    public function bee () {
        return $this->belongsToMany(Bee::class, 'bees_flowers');
    }
}
