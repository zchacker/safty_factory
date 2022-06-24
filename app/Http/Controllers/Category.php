<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use Illuminate\Http\Request;

class Category extends Controller
{
    
    public function __construct()
    {
        
    }

    public function index(Request $request)
    {
        $categories = CategoryModel::paginate(1);
        return view("categories.home" , compact('categories'));
    }


}
