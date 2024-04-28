<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
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
            'fuel_type' => [
                'nullable',
                Rule::in(\App\Models\CarUnit::FUEL_TYPE_OPTIONS)
            ],
            'transmission' => [
                'nullable',
                Rule::in(\App\Models\CarUnit::TRANSMISSION_OPTIONS)
            ],
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
        return response()->json(['message' => 'Data unit mobil berhasil ditambahkan', 'data' => $carUnit], 201);
    }

    public function destroy($id)
    {
        try {
            $carUnit = CarUnit::findOrFail($id);
            $carUnit->delete();
            
            // Response jika berhasil menghapus data
            return response()->json(['message' => 'Data mobil berhasil dihapus'], 200);
        } catch (\Exception $e) {
            // Response jika terjadi kesalahan saat menghapus data
            return response()->json(['error' => 'Terjadi kesalahan saat menghapus data mobil'], 500);
        }
    }

    public function update(Request $request, $id)
    {   

        $carUnit = CarUnit::findOrFail($id);
        // Validasi data formulir update
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
            'year' => 'required|integer',
            'fuel_type' => [
                'nullable',
                Rule::in(\App\Models\CarUnit::FUEL_TYPE_OPTIONS)
            ],
            'transmission' => [
                'nullable',
                Rule::in(\App\Models\CarUnit::TRANSMISSION_OPTIONS)
            ],
            'seat' => 'required|integer',
            'warranty' => 'required|string',
            'color' => 'required|string|max:255',
            'mileage' => 'required|numeric',
            'engine_cc' => 'required|numeric',
            'service_book' => 'required|numeric',
            'spare_key' => 'required|numeric',
            'unit_document' => 'required|numeric',
            'stnk_validity_period' => 'required|string',
            'description' => 'required|string',
        ]);

        // Temukan unit mobil berdasarkan ID
        

        // Update data unit mobil dengan data yang diterima dari formulir
        $carUnit->update($request->all());
        return response()->json(['message' => 'Data mobil berhasil diperbarui.']);

        // Redirect atau kirim respons sesuai kebutuhan aplikasi Anda
    }

}