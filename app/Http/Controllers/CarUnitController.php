<?php

namespace App\Http\Controllers;

use App\Models\CarUnit;
use Illuminate\Http\Request;

class CarUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carUnits = CarUnit::all();
        return view('tampilan-admin.car-units', compact('carUnits'));
    }
}