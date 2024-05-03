<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckUnitController extends Controller
{
    public function index(){
        return view('tampilan-admin.check-units');
    }
}
