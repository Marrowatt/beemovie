<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Month;

class MonthController extends Controller
{
    public function getMonths () {

        $months = Month::select('name', 'id')->get();

        return $months->toArray();
    }
}
