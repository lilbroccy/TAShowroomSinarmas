<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;

class BrandsController extends Controller
{
    /**
     * Menampilkan daftar brand.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all();
        return view('brands.index', compact('brands'));
    }

    /**
     * Menampilkan formulir untuk membuat brand baru.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('brands.create');
    }

    /**
     * Menyimpan brand baru ke database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:brands,name',
            'brand_logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Upload logo brand
        $imagePath = $request->file('brand_logo')->store('brand_logos', 'public');

        // Simpan data brand ke database
        Brand::create([
            'name' => $request->name,
            'brand_logo' => $imagePath,
        ]);

        return redirect()->route('brands.index')->with('success', 'Brand berhasil ditambahkan.');
    }

    // Metode lainnya seperti show, edit, update, dan destroy dapat ditambahkan sesuai kebutuhan.
}
