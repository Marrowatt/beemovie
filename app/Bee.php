<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bee extends Model
{
    protected $fillable = ['common_name', 'scientific_name'];
}
