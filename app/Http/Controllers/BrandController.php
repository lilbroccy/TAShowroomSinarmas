<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    /**
     * Menampilkan daftar brand.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $brands = Brand::all();
        return view('tampilan-admin.brands', compact('brands'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
        ]);
        $brand = Brand::create($validatedData);
        return response()->json(['message' => 'Data brand berhasil ditambahkan', 'data' => $brand], 201);
    }

    public function destroy($id)
    {
        try {
            $brand = Brand::findOrFail($id);
            $brand->delete();
            return response()->json(['message' => 'Data brand berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan saat menghapus data brand'], 500);
        }
    }

    public function update(Request $request, $id)
    {   

        $brand = Brand::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $brand->update($request->all());
        return response()->json(['message' => 'Data brand berhasil diperbarui.']);
    }
    
    public function getBrand()
    {
        $brands = Brand::all();
        return response()->json($brands);
    }
}
