<?php

namespace App\Http\Controllers;

use App\Models\CarUnit;
use App\Models\Brand;
use App\Models\Category;
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
        $brands = Brand::all();
        $categories = Category::all();
        return view('tampilan-admin.car-units', compact('carUnits', 'brands', 'categories'));
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima dari formulir
        $validatedData = $request->validate([
            'name' => 'required|string',
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
            'price' => 'nullable|numeric',
            'year' => 'nullable|integer',
            'fuel_type' => 'nullable|string',
            'seat' => 'nullable|integer',
            'warranty' => 'nullable|string',
            'color' => 'nullable|string',
            'mileage' => 'nullable|numeric',
            'engine_cc' => 'nullable|numeric',
            'service_book' => 'nullable|numeric',
            'spare_key' => 'nullable|numeric',
            'unit_document' => 'nullable|numeric',
            'stnk_validity_period' => 'nullable|string',
            'description' => 'nullable|string',
        ]);
        $carUnit = CarUnit::create($validatedData);
        return response()->json(['message' => 'Data unit mobil berhasil disimpan', 'data' => $carUnit], 201);
    }
}