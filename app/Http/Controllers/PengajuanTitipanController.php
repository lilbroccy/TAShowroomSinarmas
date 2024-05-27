<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\CarUnit;
use App\Models\Photo;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class PengajuanTitipanController extends Controller
{
    public function store(Request $request)
    {
        // Validasi data yang diterima dari request
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
            'description' => 'nullable|string'
        ]);
        
        $user_id = Auth::id();
        $carUnit = new CarUnit();
        $carUnit->fill($validatedData);
        $carUnit->user_id = $user_id;
        $carUnit->type = 'Titipan';
        $carUnit->type_status = 'Menunggu Verifikasi';
        $carUnit->save();
        
        $request->validate([
            'photos.*' => 'required|image|mimes:png,jpg,jpeg,webp'
        ]);
        foreach ($request->file('photos') as $photo) {
            $timestamp = time();
            $filename = date('Y-m-d') . '_' . $timestamp . '_' . $photo->getClientOriginalName();
            $path = 'car-units-photos/' . $filename;
            Storage::disk('public')->put($path, file_get_contents($photo));
            $photoData = [
                'car_unit_id' => $carUnit->id,
                'file_path' => $path
            ];
            Photo::create($photoData);
        }
        return response()->json(['message' => 'Data mobil berhasil disimpan!']);
    }

    public function index()
    {
        $carUnits = CarUnit::where('type', 'Titipan')->get();
        $brands = Brand::all();
        $categories = Category::all();
        return view('tampilan-admin.mobil-titipan', compact('carUnits', 'brands', 'categories'));
    }

}
