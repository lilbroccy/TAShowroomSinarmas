<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarUnit;
use App\Models\Category;

class HomeController extends Controller
{
    //
    public function index()
    {
        $categories = Category::all();
        $carUnits = CarUnit::all();

        return view('index', compact('categories', 'carUnits'));
    }
}
