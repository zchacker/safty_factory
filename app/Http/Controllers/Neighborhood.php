<?php

namespace App\Http\Controllers;

use App\Models\NeighborhoodsModel;
use Illuminate\Http\Request;

class Neighborhood extends Controller
{
    
    public function __construct()
    {
        
    }

    public function index(Request $request)
    {
        $neighborhoods = NeighborhoodsModel::paginate(1);
        return view("neighborhoods.home" , compact('neighborhoods'));
    }

}
